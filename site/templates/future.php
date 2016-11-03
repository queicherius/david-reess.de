<section class="projects">

	<?php $projects = $pages->find('projects')
							->children()
							->sortBy('date', 'desc'); ?>

	<?php foreach ($projects as $project): ?>

		<article>

			<?php $image = $project->images()
								   ->find('preview.png'); ?>

			<img src="<?php echo $image->url(); ?>" />

			<h1><?php echo $project->title(); ?></h1>

			<time><?php echo $project->date('d.m.Y'); ?></time>

			<?php echo kirbytext($project->text()); ?>

			<a href="<?php echo $project->project(); ?>"><?php echo $project->project(); ?></a>
			
			<small><?php echo $project->technologies(); ?></small>

		</article>

	<?php endforeach; ?>

</section>