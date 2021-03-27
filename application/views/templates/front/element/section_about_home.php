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
				<?php } ?>

				<?php if (sitelang() == 'indonesian') { ?>
					<p><?php echo $company['name']; ?> adalah Perusahaan Rekrutmen dan Penempatan yang mengkhususkan diri dalam tenaga kerja trampil Indonesia di luar negeri. Kami berdedikasi untuk memberikan kesempatan yang lebih besar kepada sesama orang Indonesia tidak hanya untuk berbagi kemampuan dan bakat mereka dalam bekerja di berbagai bidang di mana kualifikasi mereka paling sesuai, tetapi juga untuk mendapatkan lebih banyak dan diberi kompensasi dengan manfaat yang lebih baik juga.</p>

					<p><?php echo $company['name']; ?> memahami bahwa modal kepemimpinan memainkan peran kunci dalam kinerja organisasi mana pun.</p>
				<?php } ?>

				<?php if (sitelang() == 'japanese') { ?>
					<p><?php echo $company['name']; ?> は、海外で熟練したインドネシア人労働力を専門とする採用および配置会社です. 私たちは、仲間のインドネシア人が彼らの資格が最も適している分野で働く能力と才能を共有するだけでなく、より多くを得て、より良い利益で補償されるより大きな機会を提供することに専念しています.</p>

					<p><?php echo $company['name']; ?> は、リーダーシップ資本があらゆる組織のパフォーマンスにおいて重要な役割を果たすことを理解しています.</p>
				<?php } ?>

				<?php if (sitelang() == 'korean') { ?>
					<p><?php echo $company['name']; ?> adalah Perusahaan Rekrutmen dan Penempatan yang mengkhususkan diri dalam tenaga kerja trampil Indonesia di luar negeri. Kami berdedikasi untuk memberikan kesempatan yang lebih besar kepada sesama orang Indonesia tidak hanya untuk berbagi kemampuan dan bakat mereka dalam bekerja di berbagai bidang di mana kualifikasi mereka paling sesuai, tetapi juga untuk mendapatkan lebih banyak dan diberi kompensasi dengan manfaat yang lebih baik juga.</p>

					<p><?php echo $company['name']; ?> memahami bahwa modal kepemimpinan memainkan peran kunci dalam kinerja organisasi mana pun.</p>
				<?php } ?>

				<?php if (sitelang() == 'mandarin') { ?>
					<p><?php echo $company['name']; ?> 是一家招聘和安置公司，专门从事国外熟练的印度尼西亚劳动力. 我们致力于为印尼同胞提供更多的机会，不仅可以分享他们在最适合其学历的领域工作的能力和才华，而且还可以获得更多并获得更好的福利待遇.</p>

					<p><?php echo $company['name']; ?> 明白，领导资本在任何组织的绩效中都起着关键作用.</p>
				<?php } ?>

				<a href="<?php echo base_url('about'); ?>" class="btn btn-outline-secondary rounded-0"><?php echo $this->lang->line('button')['readmore']; ?></a>
			</div>
		</div>
	</div>
</section>