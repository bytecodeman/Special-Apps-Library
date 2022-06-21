		$(function() {
			$(".ipaddr").click(function() {
				const ipaddr = $(this).text();
				const $link = $(this);
				$.getJSON("../library/php/proxy.php?ip=" + ipaddr, function(data) {
					let location = "";
					if (data.city && data.city.trim() !== "") {
						location += data.city.trim();
					}

					let region = "";
					if (data.country_code && data.country_code === "US")
					{
						region = data.region_code ? data.region_code : "";
					}
					else if (data.country_name)
					{
						region = data.country_name;
					}

					region = region.trim();
					if (region !== "") {
						if (location !== "") {
							location += ", ";
						}
						location += region;
					}
					if (location === "") {
						location = "Cannot GeoLocate";
					}
					$link.parent().next().text(location);
				});
				return false;
			});
		});
