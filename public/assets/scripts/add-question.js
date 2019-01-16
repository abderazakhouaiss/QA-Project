$(document).ready(function () {
    $('#add-image').on('click',function () {
        var content = '<div class="col-md-9" style="margin-bottom: 3px;"><input type="text" class="form-control" placeholder="Composer un lien image" name="image[]"></div>';
        $('#content-image').append(content)
    })

    $('#add-video').on('click',function () {
        var content = '<div class="col-md-9" style="margin-bottom: 3px;"><input type="text" class="form-control" placeholder="Composer un lien video" name="video[]"></div>';
        $('#content-video').append(content)
    })
})