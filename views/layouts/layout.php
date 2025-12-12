<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo isset($title) ? esc($title) . ' - ' . APP_NAME : APP_NAME; ?></title>
	<link rel="stylesheet" href="<?= url('assets/css/style.css') ?>">

	<link href="https://fonts.googleapis.com/css2?family=Bangers&family=Comic+Neue:wght@700&family=Fredoka+One&display=swap" rel="stylesheet">
	<?php
	$cssPath = PUBLIC_PATH . '/assets/css/style.css';
	$ver = file_exists($cssPath) ? filemtime($cssPath) : (defined('APP_VERSION') ? APP_VERSION : time());
	?>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen w-full font-[&#x27;Bangers&#x27;,_cursive] overflow-x-hidden relative" style="background-color:#ffeb3b;background-image:radial-gradient(#ff0090 20%, transparent 20%);background-size:20px 20px">
	<div>
		<div class="flex justify-center w-full min-h-screen items-start xl:py-8">
			<div class="max-w-7xl bg-white md:border-[6px] border-black shadow-[15px_15px_0px_0px_rgba(0,0,0,1)] relative overflow-hidden flex flex-col">
				<?php if (!isset($hide_nav)): ?> <!-- Masquer le header si $hide_nav est défini -->
					<header>
						<nav class="bg-cyan-300 border-b-[6px] border-black p-4 flex flex-col md:flex-row justify-between items-center gap-6 relative z-20">
							<div class="transform -rotate-2 hover:rotate-0 transition-transform cursor-pointer">
								<h1 class="text-6xl md:text-7xl text-pink-500 drop-shadow-[4px_4px_0px_rgba(0,0,0,1)]" style="-webkit-text-stroke:2px black">CANDY LAND!</h1>
							</div>
							<div class="flex flex-wrap gap-4 md:gap-8 items-center justify-center"><a href="<?php echo url(); ?>" class="group relative transition-transform hover:scale-110">
									<div class="absolute inset-0 bg-black rotate-3 rounded-lg"></div>
									<div class="relative bg-yellow-400 border-[3px] border-black px-6 py-2 text-2xl tracking-wider transform -rotate-3 group-hover:rotate-0 transition-all">ACCUEIL</div>
								</a>
								<a href="<?php echo url('product/index'); ?>" class="group relative transition-transform hover:scale-110">
									<div class="absolute inset-0 bg-black -rotate-2 rounded-lg"></div>
									<div class="relative bg-pink-500 text-white border-[3px] border-black px-6 py-2 text-2xl tracking-wider transform rotate-2 group-hover:rotate-0 transition-all">PRODUITS</div>
								</a>
								<?php if (is_logged_in()): ?>
									<a href="<?php echo url('home/profile'); ?>" class="group relative transition-transform hover:scale-110">
										<div class="absolute inset-0 bg-black rotate-1 rounded-lg"></div>
										<div class="relative bg-cyan-400 border-[3px] border-black px-6 py-2 text-2xl tracking-wider transform -rotate-1 group-hover:rotate-0 transition-all">PROFIL</div>
									</a>
									<a href="<?php echo url('auth/logout'); ?>" class="group relative transition-transform hover:scale-110">
										<div class="absolute inset-0 bg-black rotate-1 rounded-lg"></div>
										<div class="relative bg-cyan-400 border-[3px] border-black px-6 py-2 text-2xl tracking-wider transform -rotate-1 group-hover:rotate-0 transition-all">DECONNEXION</div>
									</a>
							</div>
						<?php else: ?>
							<a href="<?php echo url('auth/login'); ?>" class="group relative transition-transform hover:scale-110">
								<div class="absolute inset-0 bg-black rotate-1 rounded-lg"></div>
								<div class="relative bg-cyan-400 border-[3px] border-black px-6 py-2 text-2xl tracking-wider transform -rotate-1 group-hover:rotate-0 transition-all">COMPTE</div>
							</a>
						<?php endif; ?>





						<div class="flex gap-4">
							<button class="bg-white border-[3px] border-black p-2 hover:bg-gray-100 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:translate-y-1 active:shadow-none transition-all"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search" aria-hidden="true">
									<path d="m21 21-4.34-4.34"></path>
									<circle cx="11" cy="11" r="8"></circle>
								</svg></button>
							<a href="<?php echo url('cart/index'); ?>"><button class="bg-yellow-400 border-[3px] border-black p-2 hover:bg-yellow-300 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:translate-y-1 active:shadow-none transition-all relative"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart" aria-hidden="true">
										<circle cx="8" cy="21" r="1"></circle>
										<circle cx="19" cy="21" r="1"></circle>
										<path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
									</svg></button></a>
						</div>
						</nav>
					</header>
				<?php endif; ?>

				<main class="relative">
					<?= $content ?>
					<div class="py-12">
						<ul class="flex flex-col gap-x-6"></ul>
					</div>
				</main>
				<footer class="bg-black text-white border-t-[6px] border-black relative">
					<div class="h-4 w-full bg-yellow-400" style="background-image:linear-gradient(135deg, #000 25%, transparent 25%), linear-gradient(225deg, #000 25%, transparent 25%);background-size:20px 20px;background-position:0 0"></div>
					<div class="p-8 md:p-12 grid grid-cols-1 md:grid-cols-3 gap-12 items-start">
						<div class="flex flex-col gap-4">
							<h3 class="text-5xl text-yellow-400" style="-webkit-text-stroke:1px white">DON&#x27;T MISS OUT!</h3>
							<p class="text-2xl font-sans font-bold uppercase">Subscribe for explosive deals &amp; sugar rushes.</p>
							<div class="flex gap-0 transform -rotate-1 hover:rotate-0 transition-transform">
								<div class="relative w-full"><input type="email" placeholder="YOUR EMAIL..." class="w-full bg-white text-black border-[3px] border-r-0 border-black p-3 font-sans font-bold text-lg focus:outline-none" /></div><button class="bg-pink-500 text-white border-[3px] border-black px-4 hover:bg-pink-400 flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail" aria-hidden="true">
										<path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path>
										<rect x="2" y="4" width="20" height="16" rx="2"></rect>
									</svg></button>
							</div>
						</div>
						<div class="flex flex-col gap-2 text-center md:text-left">
							<h4 class="text-3xl text-cyan-400 underline decoration-wavy decoration-2 underline-offset-4 mb-2">QUICK LINKS</h4>
							<ul class="space-y-2 text-2xl tracking-wide">
								<li><a href="<?php echo url('home/about'); ?>" class="hover:text-yellow-400 hover:translate-x-2 inline-block transition-all">ABOUT US</a></li>
								<li><a href="#" class="hover:text-yellow-400 hover:translate-x-2 inline-block transition-all">SHIPPING</a></li>
								<li><a href="<?php echo url('home/contact'); ?>" class="hover:text-yellow-400 hover:translate-x-2 inline-block transition-all">CONTACT</a></li>
								<li><a href="#" class="hover:text-yellow-400 hover:translate-x-2 inline-block transition-all">RETURNS</a></li>
							</ul>
						</div>
						<div class="flex flex-col items-center md:items-end gap-6">
							<h4 class="text-3xl text-pink-500" style="-webkit-text-stroke:1px white">FOLLOW THE FUN</h4>
							<div class="flex gap-4"><a href="#" class="bg-white text-black border-[3px] border-black p-2 rounded-lg hover:-translate-y-1 hover:bg-yellow-400 hover:shadow-[4px_4px_0px_0px_#fff] transition-all"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram" aria-hidden="true">
										<rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
										<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
										<line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
									</svg></a><a href="#" class="bg-white text-black border-[3px] border-black p-2 rounded-lg hover:-translate-y-1 hover:bg-cyan-400 hover:shadow-[4px_4px_0px_0px_#fff] transition-all"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook" aria-hidden="true">
										<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
									</svg></a><a href="#" class="bg-white text-black border-[3px] border-black p-2 rounded-lg hover:-translate-y-1 hover:bg-pink-500 hover:shadow-[4px_4px_0px_0px_#fff] transition-all"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter" aria-hidden="true">
										<path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
									</svg></a></div>
							<div class="text-right">
								<p class="font-sans text-sm text-gray-400">© 2025 CANDY LAND INC.</p>
							</div>
						</div>
					</div>
					<div class="border-t-[3px] border-white/20 bg-black p-4 flex flex-col md:flex-row justify-between items-center gap-4 font-sans text-sm text-gray-400 font-bold tracking-wide">
						<div class="flex gap-6 flex-wrap justify-center"><a href="<?php echo url('home/mentions_legales'); ?>" class="hover:text-yellow-400 transition-colors">MENTIONS LÉGALES</a><span class="hidden md:inline">|</span><a href="#" class="hover:text-cyan-400 transition-colors">CGV</a><span class="hidden md:inline">|</span><a href="#" class="hover:text-pink-500 transition-colors">POLITIQUE DE CONFIDENTIALITÉ</a><span class="hidden md:inline">|</span><a href="#" class="hover:text-white transition-colors">COOKIES</a></div>
						<div class="text-gray-600 uppercase">Candy Land v0.0</div>
					</div>
				</footer>
			</div>
		</div>
	</div>
	<script src="<?php echo url('assets/js/app.js'); ?>"></script>
</body>

</html>