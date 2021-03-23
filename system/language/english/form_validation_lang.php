<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['form_validation_required']				= ucfirst('{field} is required.');
$lang['form_validation_isset']					= ucfirst('{field} must have a value.');
$lang['form_validation_valid_email']			= ucfirst('{field} must contain a valid email address.');
$lang['form_validation_valid_emails']			= ucfirst('{field} must contain all valid email addresses.');
$lang['form_validation_valid_url']				= ucfirst('{field} must contain a valid URL.');
$lang['form_validation_valid_ip']				= ucfirst('{field} must contain a valid IP.');
$lang['form_validation_valid_base64']			= ucfirst('{field} must contain a valid Base64 string.');
$lang['form_validation_min_length']				= ucfirst('{field} must be at least {param} characters in length.');
$lang['form_validation_max_length']				= ucfirst('{field} cannot exceed {param} characters in length.');
$lang['form_validation_exact_length']			= ucfirst('{field} must be exactly {param} characters in length.');
$lang['form_validation_alpha']					= ucfirst('{field} may only contain alphabetical characters.');
$lang['form_validation_alpha_numeric']			= ucfirst('{field} may only contain alpha-numeric characters.');
$lang['form_validation_alpha_numeric_spaces']	= ucfirst('{field} may only contain alpha-numeric characters and spaces.');
$lang['form_validation_alpha_dash']				= ucfirst('{field} may only contain alpha-numeric characters, underscores, and dashes.');
$lang['form_validation_numeric']				= ucfirst('{field} must contain only numbers.');
$lang['form_validation_is_numeric']				= ucfirst('{field} must contain only numeric characters.');
$lang['form_validation_integer']				= ucfirst('{field} must contain an integer.');
$lang['form_validation_regex_match']			= ucfirst('{field} is not in the correct format.');
$lang['form_validation_matches']				= ucfirst('{field} does not match the {param} field.');
$lang['form_validation_differs']				= ucfirst('{field} must differ from the {param} field.');
$lang['form_validation_is_unique'] 				= ucfirst('{field} must contain a unique value.');
$lang['form_validation_is_natural']				= ucfirst('{field} must only contain digits.');
$lang['form_validation_is_natural_no_zero']		= ucfirst('{field} must only contain digits and must be greater than zero.');
$lang['form_validation_decimal']				= ucfirst('{field} must contain a decimal number.');
$lang['form_validation_less_than']				= ucfirst('{field} must contain a number less than {param}.');
$lang['form_validation_less_than_equal_to']		= ucfirst('{field} must contain a number less than or equal to {param}.');
$lang['form_validation_greater_than']			= ucfirst('{field} must contain a number greater than {param}.');
$lang['form_validation_greater_than_equal_to']	= ucfirst('{field} must contain a number greater than or equal to {param}.');
$lang['form_validation_error_message_not_set']	= 'Unable to access an error message corresponding to your field name {field}.';
$lang['form_validation_in_list']				= ucfirst('{field} must be one of: {param}.');
