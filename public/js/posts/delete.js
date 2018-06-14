$(document).ready(function () {
    $('.del').click(function () {
        if (confirm('Вы действительно хотите удалить запись?')) {
            $.ajax({
                method: 'post',
                url: '/posts/delete',
                data: {
                    'id': $(this).data('id')
                },
                error: function (data) {
                    console.log(data);return false;
                },
                success: function (data) {
                    var j = JSON.parse(data);
                    if (j.status === true) {
                        window.location.href = '/posts';
                    } else {
                        console.log(j)
                    }
                }
            });
        }
    });
});