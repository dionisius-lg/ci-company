<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-12 order-1 order-lg-2">
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
					<p><?php echo $company['name']; ?> 는 해외에서 숙련 된 인도네시아 인력을 전문으로하는 채용 및 배치 회사입니다. 우리는 인도네시아 동료들이 자신의 자격이 가장 적합한 분야에서 일하면서 자신의 능력과 재능을 공유 할뿐만 아니라 더 많은 것을 얻고 더 나은 혜택으로 보상을받을 수있는 더 큰 기회를 제공하기 위해 최선을 다하고 있습니다.</p>

					<p><?php echo $company['name']; ?> 은 리더십 자본이 모든 조직의 성과에서 핵심적인 역할을한다는 것을 이해합니다.</p>
				<?php } ?>

				<?php if (sitelang() == 'mandarin') { ?>
					<p><?php echo $company['name']; ?> 是一家招聘和安置公司，专门从事国外熟练的印度尼西亚劳动力. 我们致力于为印尼同胞提供更多的机会，不仅可以分享他们在最适合其学历的领域工作的能力和才华，而且还可以获得更多并获得更好的福利待遇.</p>

					<p><?php echo $company['name']; ?> 明白，领导资本在任何组织的绩效中都起着关键作用.</p>
				<?php } ?>

				<a href="<?php echo base_url('about'); ?>" class="btn btn-outline-secondary rounded-0"><?php echo $this->lang->line('button')['readmore']; ?></a>
			</div>

			<div class="col-lg-6 col-12 order-2 order-lg-1 filter-workers">
				<h5 class="title">Quick Search</h5>
				<div class="row">
					<div class="col-md-6 pad-right-5">
						<ul class="nav flex-column">
							<?php foreach ($agency_locations as $oversea_experience) { echo
								'<li class="nav-item">
									<a href="' . base_url('worker?oversea_experience=' . $oversea_experience['slug']) . '" class="nav-link">
										' . $oversea_experience['name'] . ' <span> ' . $oversea_experience['total_worker_oversea_experience'] . ' </span>
									</a>
								</li>';
							} ?>
						</ul>
					</div>

					<div class="col-md-6 pad-left-5">
						<ul class="nav flex-column">
							<?php foreach ($experiences as $experience) { echo
								'<li class="nav-item">
									<a href="' . base_url('worker?experience=' . $experience['slug']) . '" class="nav-link">
										' . $experience['name'] . ' <span> ' . $experience['total_worker'] . ' </span>
									</a>
								</li>';
							} ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>