<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-12 order-2 order-lg-1">
				<img class="img-fluid" src="<?php echo base_url('assets/img/about/about-1.jpg'); ?>" alt="">
			</div>

			<div class="col-lg-7 col-12 order-1 order-lg-2">
				<h4><?php echo $company['name']; ?></h4>
				<?php if (sitelang() == 'english') { ?>
					<p><?php echo $company['name']; ?> is a Recruitment and Placement Company that specializes in skilled Indonesian workforce abroad. We are dedicated to providing greater opportunities for fellow Indonesians not only to share their abilities and talents in working in areas where their qualifications are most suitable, but also to get more and be compensated with better benefits as well.</p>

					<p><?php echo $company['name']; ?> understands that leadership capital plays a key role in the performance of any organization.</p>

					<a href="<?php echo base_url('about'); ?>" class="btn btn-more">Read More</a>
				<?php } else { ?>
					<p><?php echo $company['name']; ?> adalah Perusahaan Rekrutmen dan Penempatan yang mengkhususkan diri dalam tenaga kerja trampil Indonesia di luar negeri. Kami berdedikasi untuk memberikan kesempatan yang lebih besar kepada sesama orang Indonesia tidak hanya untuk berbagi kemampuan dan bakat mereka dalam bekerja di berbagai bidang di mana kualifikasi mereka paling sesuai, tetapi juga untuk mendapatkan lebih banyak dan diberi kompensasi dengan manfaat yang lebih baik juga.</p>

					<p><?php echo $company['name']; ?> memahami bahwa modal kepemimpinan memainkan peran kunci dalam kinerja organisasi mana pun.</p>

					<a href="<?php echo base_url('about'); ?>" class="btn btn-more">Selengkapnya</a>
				<?php } ?>
			</div>
		</div>
	</div>
</section>