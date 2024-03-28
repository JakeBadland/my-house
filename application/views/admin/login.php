<? include ('core/views/blocks/admin_head.php'); ?>

<div id="container">
    <div id="header">
<!--        --><?// include ('core/views/admin/blocks/menu.php'); ?>
    </div>

    <div id="body">
        <div class="row active">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default login-form">
                    <div class="panel-heading">
                        <h3 class="panel-title">Необходима авторизация</h3>
                    </div>
                    <div class="panel-body">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon">></span>
                            <input type="text" id="login" class="form-control" placeholder="Логин">
                        </div>
                        <br />
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon">></span>
                            <input type="password" id="pass" class="form-control" placeholder="Пароль">
                        </div>
                        <br />
                        <button id="submit" class="btn btn-default">Отправить</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

    <div id="footer">

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click', '#submit', function(e){
            e.preventDefault();
            var data = {};

            data.login = $('.login-form').find('#login').val();
            data.pass = $('.login-form').find('#pass').val();

            $.post('/auth/ajax_login', {data: data}, function(data){
                data = $.parseJSON(data);
                if (data.status){
                    window.location.href= '/dna/messages';
                }else{
                    log.show('error', data.message, 'top', 3000);
                }
            })
        })
    });
</script>

