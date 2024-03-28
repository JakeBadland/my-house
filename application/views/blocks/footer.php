<div class="hi-panel m-l2" data-page="0">
    <a name="comments_block"></a>
    <h2 class="footer-desc">Отзывы:</h2>

    <div class="comment-container m-l1">
        <div class="comment-reply">
            <a href="#">Оставить отзыв</a>
        </div>
        <div class="comment-reply-form">
            <table class="table">
                <tbody>
                <tr>
                    <td>Ваше имя<span class="c-red">*</span></td>
                    <td>
                        <input type="text" id="user_name" placeholder="">
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="text" id="user_email" placeholder="">
                        <span class="help-icon-comments">
                                <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                        </span>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="help-hint-comments" style="display: none">
                Заполните поле email для получения уведомления об ответе на Ваш отзыв.
            </div>
            <span>Текст сообщения<span class="c-red">*</span></span>
            <br/>
            <textarea cols="10" rows="5" id="admin_message_text" placeholder=""></textarea>
            <br/>
            <label><span class="c-red">*</span> <span class="text-required"> - обязательное поле</span></label>
            <br/>
            <br/>
            <input type="button" id="send_comment" value="Отправить">
            <input type="button" id="cancel_comment" value="Отмена">
        </div>
    </div>

    <?php if (!empty($this->comments_list)) : ?>
        <?php foreach ($this->comments_list as $comment) : ?>
            <?php $file_name = APPPATH . 'views/blocks/comment.php'; ?>
            <?php include($file_name); ?>
            <?php if ($comment->child_comments) : ?>
                <?php foreach ($comment->child_comments as $comment) : ?>
                    <? include($file_name); ?>
                <?php endforeach; ?>
            <?php endif?>
        <?php endforeach; ?>

        <div class="comment-container m-l1">
            <div class="comment-load">
                <a href="#" id="load_more_comments">Еще ...</a>
            </div>
        </div>

    <?php endif ?>

</div>
<div class="low-panel m-l2">
    <br/>
    <div class="t-white copyright">
        <span>© 2004 - <?=date('Y')?> Строительство|Ремонт</span>
        <a href="https://vk.com/public131003012" target="_blank">
            <label class="social-ico icon-vk"></label>
        </a>
        <a href="https://www.facebook.com/groups/1952409971553777" target="_blank">
            <label class="social-ico icon-fb"></label>
        </a>
        <a href="https://instagram.com/building.od.ua?utm_source=ig_profile_share&igshid=1nxf5xvu9dhx6" target="_blank">
            <label class="social-ico icon-insta"></label>
        </a>
    </div>
    <br/>
</div>

<?php
$this->load->view('admin/blocks/modal_confirm.php');
//include('core/views/admin/blocks/modal_confirm.php');
?>

<div class="modal fade" id="modal_edit_comment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Редактирование комментария</h4>
            </div>
            <div class="modal-body">
                <label for="modal_user_name">Имя:</label><br/>
                <input type="text" id="modal_user_name"><br/>
                <br/>
                <label for="modal_text">Текст:</label><br/>
                <textarea id="modal_text"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirm_edit_comment">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_reply_comment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Ответ на комментарий</h4>
            </div>
            <div class="modal-body">
                <div class="help-hint-messages" style="display: none">
                    Заполните поле Email для получения уведомления об ответе на Ваш отзыв.
                </div>

                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td>Ваше имя<span class="c-red">*</span></td>
                        <td>
                            <input type="text" id="reply_user_name" placeholder="Ваше имя">
                        </td>
                    </tr>
                    <tr>
                        <td>Ваш Email</td>
                        <td>
                            <input type="text" id="reply_email" placeholder="Ваш Email">
                            <span class="help-icon-messages">
                                <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br/>
                <br/>
                <textarea id="reply_text" placeholder="Текст сообщения"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirm_reply_comment">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_admin_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Задать вопрос</h4>
            </div>
            <div class="modal-body">
                <div class="help-hint-messages" style="display: none">
                    Обычно консультант отвечает в течение 2-х минут. Но если все консультанты заняты - ответ будет дан
                    позже. В этом случае удобно получить уведомление об ответе на email. Заполните поле email для
                    получения уведомления об ответе.
                </div>
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td>Ваше имя<span class="c-red">*</span></td>
                        <td>
                            <input type="text" id="admin_message_user_name" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <input type="text" id="admin_message_email" placeholder="">
                            <span class="help-icon-messages">
                                <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <span>Текст сообщения<span class="c-red">*</span></span>
                <br/>
                <textarea id="admin_message_text" placeholder=""></textarea>
                <br/>
                <br/>
                <label><span class="c-red">*</span> <span class="text-required"> - обязательное поле</span></label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirm_admin_message">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_messages_dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content messages-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <b><h4 class="modal-title" id="myModalLabel">Консультант: <b class="consultant-name"></b></h4></b>
            </div>
            <div class="modal-body">
                <div class="dialog"></div>
                <br/>
                <textarea id="message_reply"></textarea>
                <br/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="send_message_reply">Отправить</button>
            </div>
        </div>
    </div>
</div>

<div id="admin_message">
    <div class="new-messages hidden">
        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
    </div>
    <img class="shadow" src="/images/FeadbackButton.png">
</div>

<div class="notify-icon" id="go_up">
    <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
</div>

<?php //if ($this->db_errors && isset($this->self_author->is_admin) && $this->self_author->is_admin == true) : ?>
    <script>
        $(document).ready(function () {
            //log.clear();
            //log.show('error', 'За текущие сутки при запросах в базу произошли ошибки. Сообщите разработчику.');
        });
    </script>
<?php // endif; ?>

</body>
</html>
