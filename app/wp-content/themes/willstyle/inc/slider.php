
	<?php $slideImgs = SCF::get( 'slide-images' );?>
	<?php $slideImg = SCF::get( 'slide-image' );?>
	<?php if(is_array($slideImg)):?>
	<?php if(count($slideImg) < 2):?>
	<?php foreach($slideImgs as $v):?>
	<?php if(!empty($v['slide-image'])):?>
	<div class="blog-slider-wraper">
		<div class="text-center">
			<div class="mb30 lightbox--gallery">
				<figure>
					<a href="<?php echo wp_get_attachment_image_src($v['slide-image'],'large')[0];?>" <?php if(!empty($v['slide-comment'])):?>data-title="<?php echo esc_html($v['slide-comment']);?>"<?php endif;?>>
						<img src="<?php echo wp_get_attachment_image_src($v['slide-image'],'large')[0];?>" alt="<?php the_title();?>">
						<?php if(!empty($v['slide-comment'])):?><figcaption ><?php echo esc_html($v['slide-comment']);?></figcaption><?php endif;?>
					</a>
				</figure>
			</div>
		</div>
	</div>
	<?php endif;?>
	<?php endforeach;?>
	<?php else:?>
	<div class="blog-slider-wraper">
		<div class="blog-slider swiper-container text-center">
			<div class="swiper-wrapper">
				<?php foreach($slideImgs as $k => $v):?>
				<?php if(!empty($v['slide-image'])):?>
				<div class="swiper-slide align-self-center">
					<a href="<?php echo wp_get_attachment_image_src($v['slide-image'],'large')[0];?>" <?php if(!empty($v['slide-comment'])):?>data-title="<?php echo esc_html($v['slide-comment']);?>"<?php endif;?>>
						<img src="<?php echo wp_get_attachment_image_src($v['slide-image'],'large')[0];?>" alt="<?php the_title();?>">
						<?php if(!empty($v['slide-comment'])):?><figcaption ><?php echo esc_html($v['slide-comment']);?></figcaption><?php endif;?>
					</a>
				</div>
				<?php endif;?>
				<?php endforeach;?>
			</div>

			<div class="swiper-pagination"></div>
			<div class="swiper-button-prev swiper-button-white"></div>
			<div class="swiper-button-next swiper-button-white"></div>
		</div>
	</div>
	<div class="blog-slider-thumbnails mb20">
		<div class="row gutters-2-5 align-items-end lightbox--gallery">
			<?php foreach($slideImgs as $k => $v):?>
			<?php if(!empty($v['slide-image'])):?>
			<div class="col-lg-1 col-2 mb5">
				<a href="">
					<img src="<?php echo wp_get_attachment_image_src($v['slide-image'],'large')[0];?>" alt="" class="object-fit-images">
				</a>
			</div>
			<?php endif;?>
			<?php endforeach;?>
		</div>
	</div>
<?php endif;?>
<?php endif;?>