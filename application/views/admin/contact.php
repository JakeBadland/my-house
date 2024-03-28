<? include('core/views/blocks/admin_head.php'); ?>

<div id="container">
    <div id="header">
        <? include('core/views/admin/blocks/menu.php'); ?>
    </div>

    <div id="body">

        <label>Имя консультанта:</label>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="contact-item">
                    <input id="consultant_name" type="text" value="<?=$this->consultant_name?>">
                </div>
                <div class="mb20"></div>
                <button type="button" class="btn btn-default" id="save_consultant">Сохранить</button>
            </div>
        </div>

        <label>Телефон в шапке:</label>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="contact-item">
                    <input id="main_phone" type="text" value="<?=$this->main_phone?>">
                </div>
                <div class="mb20"></div>
                <button type="button" class="btn btn-default" id="save_main_phone">Сохранить</button>
            </div>
        </div>

        <label>Телефоны:</label>
        <div class="panel panel-default">
            <div class="panel-body">
                <? foreach ($this->tels as $tel) : ?>
                    <div class="contact-item" data-object-id="<?=$tel->id?>">
                        <input type="text" class="contact-input" value="<?= $tel->text ?>">
                        <span class="fr glyphicon glyphicon-trash delete-contact-item" aria-hidden="true"></span>
                    </div>
                <? endforeach; ?>
                <div class="mb20"></div>
                <button type="button" class="btn btn-default" id="add_tel">Добавить</button>
            </div>
        </div>

        <label>Емейлы:</label>
        <div class="panel panel-default">
            <div class="panel-body">
                <? foreach ($this->emails as $email) : ?>
                    <div class="contact-item" data-object-id="<?=$email->id?>">
                        <input type="text" class="contact-input" value="<?= $email->text ?>">
                        <span class="fr glyphicon glyphicon-trash delete-contact-item" aria-hidden="true"></span>
                    </div>
                <? endforeach; ?>
                <div class="mb20"></div>
                <button type="button" class="btn btn-default" id="add_email">Добавить</button>
            </div>
        </div>

        <label>Емейл шаблон:</label>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="contact-item">
                    <label for="email_subject">Тема письма:</label>
                    <input id="email_subject" type="text" value="<?=$this->email_subject?>">
                    <br/>
                    <br/>
                    <textarea class="email-text" id="email_text"><?=$this->email_text?></textarea>
                </div>
                <br/>
                <button type="button" class="btn btn-default" id="save_email">Сохранить</button>
            </div>
        </div>

        <label>Емейл шаблон ответа на коммент:</label>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="contact-item">
                    <label for="reply_subject">Тема письма:</label>
                    <input id="reply_subject" type="text" value="<?=$this->reply_email_subject?>">
                    <br/>
                    <br/>
                    <textarea class="email-text" id="reply_text"><?=$this->reply_email_text?></textarea>
                </div>
                <br/>
                <button type="button" class="btn btn-default" id="save_reply_email">Сохранить</button>
            </div>
        </div>

        <label>Емейл шаблон нотификации пользователю:</label>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="contact-item">
                    <label for="noty_subject">Тема письма:</label>
                    <input id="noty_subject" type="text" value="<?=$this->noty_email_subject?>">
                    <br/>
                    <br/>
                    <textarea class="email-text" id="noty_text"><?=$this->noty_email_text?></textarea>
                </div>
                <br/>
                <button type="button" class="btn btn-default" id="save_noty_email">Сохранить</button>
            </div>
        </div>

    </div>

    <div id="footer">

    </div>
</div>

<script>
    $(document).ready(function(){

        CKEDITOR.replace('email_text');
        CKEDITOR.replace('reply_text');
        CKEDITOR.replace('noty_text');

        //save_main_phone

        $('body').on('click', '#save_main_phone', function(){
            var data = {};
            data.main_phone = $('#main_phone').val();
            $.post('/dna/ajax_update_main_phone', {data: data}, function(){

            });
        });


        $('body').on('click', '#save_email', function(){
            var data = {};
            data.email_text = CKEDITOR.instances.email_text.getData();
            data.email_subject = $('#email_subject').val();
            $.post('/dna/ajax_update_contact_email', {data: data}, function(){

            });
        });

        $('body').on('click', '#save_reply_email', function(){
            var data = {};
            data.reply_text = CKEDITOR.instances.reply_text.getData();
            data.reply_subject = $('#reply_subject').val();
            $.post('/dna/ajax_update_reply_email', {data: data}, function(){

            });
        });

        $('body').on('click', '#save_consultant', function(){
            var data = {};
            data.consultant_name = $('#consultant_name').val();

            $.post('/dna/ajax_save_consultant', {data: data}, function(){

            });
        });

        $('body').on('click', '#save_noty_email', function(){
            var data = {};
            data.noty_text = CKEDITOR.instances.noty_text.getData();
            data.noty_subject = $('#noty_subject').val();
            $.post('/dna/ajax_update_noty_email', {data: data}, function(){

            });
        });

        $('body').on('click', '#add_tel', function(){
            $.post('/dna/ajax_add_contact_tel', {}, function(){
                location.reload();
            });
        });

        $('body').on('click', '#add_email', function(){
            $.post('/dna/ajax_add_contact_email', {}, function(){
                location.reload();
            });
        });

        $('body').on('click', '.delete-contact-item', function(){
            var $this = $(this),
                data = {};

            data.object_id = $this.parents('div[data-object-id]').data('object-id');

            $.post('/dna/ajax_del_contact_item', {data: data}, function(){
                $('div[data-object-id="'+data.object_id+'"]').remove();
            });
        });

        $('body').on('input', '.contact-input', function(){
            var object_id = $(this).parents('div[data-object-id]').data('object-id');
            $.callAfter(function(text){
                var data = {};
                data.object_id = object_id;
                data.text = text;
                $.post('/dna/ajax_update_contact_item', {data: data}, function(){

                })
            }, 500, $(this).val());
        })
    });
</script>