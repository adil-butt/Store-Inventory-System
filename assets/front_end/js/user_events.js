$(document).ready(function () {
	$('#viewUserProfilePhoto').click(function () {
		$('#userProfileImagePreview').attr('src', $('#userProfileImage').attr('src'));
		$('#userProfileImgViewModal').modal('toggle');
	});
});
