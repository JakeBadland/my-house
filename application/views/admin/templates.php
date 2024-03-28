<? include('core/views/blocks/admin_head.php'); ?>

<div id="container">
    <div id="header">
        <? include('core/views/admin/blocks/menu.php'); ?>
    </div>

    <div id="body">

        <form method="post" action="/dna/save_templates">
        <?php foreach ($this->templates as $template): ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="contact-item">
                    <label><?=$template->anchor?></label>
                    <br/>
                    <input name="<?=$template->id?>_name" type="text" value="<?=$template->name?>">
                    <br/>
                    <br/>
                    <input name="<?=$template->id?>_subject" type="text" value="<?=$template->subject?>">
                    <br/>
                    <br/>
                    <textarea class="email-text email-template" name="<?=$template->id?>_template"><?=$template->template?></textarea>
                </div>
                <br/>
            </div>
        </div>
        <?php endforeach; ?>

        <button type="sumbit" class="btn btn-default">Сохранить</button>
        </form>
    </div>

    <div id="footer">

    </div>
</div>

<script>
    $(document).ready(function(){
        /*
        let names = $('#tpl_names').val().split(',');
        for (let i = 0; i<names.length; i++){
            CKEDITOR.replace(names[i]);
        }
        */
    });
</script>