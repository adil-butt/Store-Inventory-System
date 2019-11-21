$(document).ready(function () {
	$('#viewUserProfilePhoto').click(function () {
		$('#userProfileImagePreview').attr('src', $('#userProfileImage').attr('src'));
		$('#userProfileImgViewModal').modal('toggle');
	});

	$(function(){
		var path = window.location.href;
		$('#userNav li a').each(function() {
			if (this.href === path) {
				$(this).parent().addClass('active');
				$(this).append('<span class="sr-only">(current)</span>');
			}
		})
		if(path.indexOf('home') !== -1){
			$('#userNav #navHome').addClass('active');
			$('#userNav #navHome').append('<span class="sr-only">(current)</span>');
		}
	})
});
