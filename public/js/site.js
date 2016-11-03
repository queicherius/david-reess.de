$(document)
		.ready(
				function() {

					$('.gallery a').lightBox();

					$(".style-js")
							.replaceWith(
									'<style type="text/css">#menu2 ul li a:hover {background: #000;color: #fff;} </style>');

					$("#jz-ostern").click(function() {

						alert("(\\_/)\n(oo)   Frohe Ostern!\n(><)");

					});

					$("#jz-weihnachten").click(function() {
						alert("Frohe Weihnachten!");
					});

					$("#jz-pfingsten").click(function() {
						alert("Frohe Pfingsten!");
					});

					$("#jz-sommer").click(function() {
						alert("Sommerferien!");
					});

					$("#jz-bday").click(function() {
						alert("GEBURTSTAG!!!!");
					});

					// SECOND

					$("#menu2 li a").wrapInner('<span class="out"><\/span>');

					$("#menu2 li a")
							.each(
									function() {
										$(
												'<span class="over">' + $(this)
														.text() + '<\/span>')
												.appendTo(this);
									});

					$("#menu2 li a").hover(function() {
						$(".out", this).stop().animate( {
							'top' : '45px'
						}, 200); // move down - hide
							$(".over", this).stop().animate( {
								'top' : '0px'
							}, 200); // move down - show

						}, function() {
							$(".out", this).stop().animate( {
								'top' : '0px'
							}, 200); // move up - show
							$(".over", this).stop().animate( {
								'top' : '-45px'
							}, 200); // move up - hide
						});

				});