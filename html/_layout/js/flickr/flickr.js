(function($) {
	
	$.fn.flickr = function(options) {
		
		var url = 'http://api.flickr.com/services/rest/?jsoncallback=?';
		var settings = $.extend({
			'api_key': '8098557640488f198febbcd139e753e0',			
		}, options);
		
   		return this.each(function() {
			
			var gallery = $(this);
			gallery.addClass('flickr-gallery');
			gallery.append('<div class="browser"><ul></ul></div><div class="clear"></div>');
			
			$.getJSON(url, {
				method: 'flickr.photosets.getInfo',
				api_key: settings.api_key,						
				photoset_id: settings.photoset_id,
				format: 'json'
			}).success(function() {
				
				$.getJSON(url, {
					method: 'flickr.photosets.getPhotos',
					api_key: settings.api_key,
					media: 'photos',
					photoset_id: settings.photoset_id,
					format: 'json',
					per_page: '5',
					extras: 'url_q,url_sq,url_t,url_s,url_m,url_l,url_c,url_z,url_n,date_taken,tags,o_dims'
				}).success(function(state) {
					var list = gallery.find('ul:first');
					list.html('');
					
					$i=1;
					
					$.each(state.photoset.photo, function(){
						
						if($i % 3 != 0)
							list.append('<li><a href="' + this.url_l + '"><img src="' + this.url_q + '"></a></li>');
						else

							list.append('<li><a href="' + this.url_l + '"><img src="' + this.url_q + '"></a></li>');
						$i++;
					});
					
				}).fail(function() { 
					alert("Unable to retrieve photo set"); 
				});
			}).fail(function() { 
					alert("Unable to retrieve photo set information"); 
			});
		});

	};
	
})( jQuery );