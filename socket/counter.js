const mysql = require('mysql');

// db connection
const db = mysql.createConnection({
    host: 'localhost',
    // local
    user: 'root',
    password: '',
    database: 'ci_company',
    // arj.com
    // user: 'ptarjcom_administrator',
    // password: 'ptarjcom102030',
    // database: 'ptarjcom_database',
    timezone: 'utc'
});

// log any errors connected to the db
db.connect(function(err) {
    if (err) {
        throw err;
    }
});

// function get users data
exports.getUsers = (callback) => {
    const query = "SELECT * FROM view_users WHERE is_active = 1 AND is_register = 1";

    db.query(query, function(err, res) {
        if (err) {
            callback(err);
            return;
        }

        // let data = [];

        // res.forEach(user => {
        //     data.push(user);
        // });

        let data = {};

        for (var i = 0; i < res.length; i++) {
            delete res[i]['password'];
            data[i] = res[i];
        }

        let result = JSON.stringify(data);

        callback(result);
    });
}

// function get user requests data
exports.getUserRequests = (callback) => {
    const query = "SELECT * FROM view_users WHERE is_active = 1 AND is_request_register = 1";

    db.query(query, function(err, res) {
        if (err) {
            callback(err);
            return;
        }

        let data = {};

        for (var i = 0; i < res.length; i++) {
            delete res[i]['password'];
            data[i] = res[i];
        }

        let result = JSON.stringify(data);

        callback(result);
    });
}

// function get workers data
exports.getWorkers = (callback) => {
    const query = "SELECT * FROM view_workers WHERE is_active = 1";

    db.query(query, function(err, res) {
        if (err) {
            callback(err);
            return;
        }

        let data = {};

        for (var i = 0; i < res.length; i++) {
            data[i] = res[i];
        }

        let result = JSON.stringify(data);

        callback(result);
    });
}

// function get total data
exports.getTotal = (callback) => {
    const query = "SELECT * FROM view_total_data";

    db.query(query, function(err, res) {
        if (err) {
            callback(err);
            return;
        }

        let result = JSON.stringify({
            total_user: res[0].user,
            total_user_request: res[0].user_request,
            total_worker: res[0].worker,
            total_booking_request: res[0].booking_request,
            total_booking_approve: res[0].booking_approve,
        });

        callback(result);
    });
}
