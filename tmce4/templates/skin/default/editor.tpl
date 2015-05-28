{if $oConfig->GetValue('view.tinymce')}
    <script src="{$aTemplateWebPathPlugin.tmce4}js/settings.js"></script>
    {if !$sSettingsTinymce}
        {assign var="sSettingsTinymce" value="ls.settings.getTinymce()"}
    {/if}
    <script src="{$aTemplateWebPathPlugin.tmce4}js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        jQuery(function($){
            if (!!ls.comments.setFormText){
                ls.comments.setFormText=function (sText){
                    if (this.options.wysiwyg) {
                        tinymce.execCommand('mceRemoveEditor', false, 'form_comment_text');
                        $('#form_comment_text').val(sText);
                        tinymce.execCommand('mceAddEditor', true, 'form_comment_text');
                    }
                    else if (typeof($('#form_comment_text').getObject) == 'function') {
                        $('#form_comment_text').destroyEditor();
                        $('#form_comment_text').val(sText);
                        $('#form_comment_text').redactor();
                    }
                    else
                        $('#form_comment_text').val(sText);
                }
                ls.comments.toggleCommentForm = function (idComment, bNoFocus) {
                    if (typeof (this.sBStyle) != 'undefined')
                        $('#comment-button-submit').css('display', this.sBStyle);
                    if (typeof (this.cbsclick) != 'undefined') {
                        $('#comment-button-submit').unbind('click');
                        $('#comment-button-submit').attr('onclick', this.cbsclick);
                    }
                    var b = $('#comment-button-submit-edit');
                    if (b.length)
                        b.remove();
                    b = $('#comment-button-history');
                    if (b.length)
                        b.remove();
                    b = $('#comment-button-cancel');
                    if (b.length)
                        b.remove();
                    var reply=$('#reply');
                    if(!reply.length){
                        return;
                    }
                    $('#comment_preview_' + this.iCurrentShowFormComment).remove();
                    if (this.iCurrentShowFormComment==idComment && reply.is(':visible')) {
                        reply.hide();
                        return;
                    }
                    if (this.options.wysiwyg) {
                        tinymce.execCommand('mceRemoveEditor',true,'form_comment_text');
                    }
                    reply.insertAfter('#comment_id_'+idComment).show();
                    $('#form_comment_text').val('');
                    $('#form_comment_reply').val(idComment);
                    this.iCurrentShowFormComment = idComment;
                    if (this.options.wysiwyg) {
                        tinymce.execCommand('mceAddEditor',true,'form_comment_text');
                    }
                    if (!bNoFocus) $('#form_comment_text').focus();
                    if ($('html').hasClass('ie7')) {
                        var inputs = $('input.input-text, textarea');
                        ls.ie.bordersizing(inputs);
                    }
                }
            } else {
                ls.comments.toggleCommentForm = function(idComment, bNoFocus) {
                    var reply=$('#reply');
                    if(!reply.length){
                        return;
                    }
                    $('#comment_preview_' + this.iCurrentShowFormComment).remove();
                    if (this.iCurrentShowFormComment==idComment && reply.is(':visible')) {
                        reply.hide();
                        return;
                    }
                    if (this.options.wysiwyg) {
                        tinymce.execCommand('mceRemoveEditor',true,'form_comment_text');
                    }
                    reply.insertAfter('#comment_id_'+idComment).show();
                    $('#form_comment_text').val('');
                    $('#form_comment_reply').val(idComment);
                    this.iCurrentShowFormComment = idComment;
                    if (this.options.wysiwyg) {
                        tinymce.execCommand('mceAddEditor',true,'form_comment_text');
                    }
                    if (!bNoFocus) $('#form_comment_text').focus();
                    if ($('html').hasClass('ie7')) {
                        var inputs = $('input.input-text, textarea');
                        ls.ie.bordersizing(inputs);
                    }
                }
            }
            tinymce.init({$sSettingsTinymce});
        });
    </script>
    <iframe id="tmce4_form_target" name="tmce4_form_target" style="display:none"></iframe>
        <form id="tmce4_form" action="" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            <input name="img_file" type="file" onchange="$('#tmce4_form').submit();">
        </form>
{else}
    {if !$sImgToLoad}
        {assign var="sImgToLoad" value="topic_text"}
    {/if}
    {include file='window_load_img.tpl' sToLoad=$sImgToLoad}
    {if !$sSettingsTinymce}
        {assign var="sSettingsMarkitup" value="ls.settings.getMarkitup()"}
    {/if}
    <script type="text/javascript">
        jQuery(function($){
            ls.lang.load({lang_load name="panel_b,panel_i,panel_u,panel_s,panel_url,panel_url_promt,panel_code,panel_video,panel_image,panel_cut,panel_quote,panel_list,panel_list_ul,panel_list_ol,panel_title,panel_clear_tags,panel_video_promt,panel_list_li,panel_image_promt,panel_user,panel_user_promt"});
            $('.markitup-editor').markItUp({$sSettingsMarkitup});
        });
    </script>
{/if}
