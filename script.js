document.addEventListener('DOMContentLoaded', function () {
			$('#show_more').on('click', function(e) {
				let elems = document.querySelectorAll(".elem");
				for (i = 0; i < elems.length; i++) {
					if (elems[i].style.display === 'none') {
						console.log(i);
						elems[i].style.display = 'block';
						for (j=0; j < 10; j++ )
							if (elems[i+j]) elems[i+j].style.display = 'block';
						if (i+10 >= elems.length) document.querySelector('#show_more').style.display = 'none';
						i = elems.length;
						console.log(i);
					}
				}
			});
				
				     
        });    