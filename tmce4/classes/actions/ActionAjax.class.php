<?php
class PluginTmce4_ActionAjax extends PluginTmce4_Inherit_ActionAjax {
    protected function EventUploadImage() {
        /**
         * Т.к. используется обработка отправки формы, то устанавливаем тип ответа 'jsonIframe' (тот же JSON только обернутый в textarea)
         * Это позволяет избежать ошибок в некоторых браузерах, например, Opera
         */
        $this->Viewer_SetResponseAjax('jsonIframe',false);
        /**
         * Пользователь авторизован?
         */
        if (!$this->oUserCurrent) {
            $this->Message_AddErrorSingle($this->Lang_Get('need_authorization'),$this->Lang_Get('error'));
            return;
        }
        $sFile=null;
        /**
         * Был выбран файл с компьютера и он успешно зугрузился?
         */
        if (is_uploaded_file($_FILES['img_file']['tmp_name'])) {
            if(!$sFile=$this->Topic_UploadTopicImageFile($_FILES['img_file'],$this->oUserCurrent)) {
                $this->Message_AddErrorSingle($this->Lang_Get('uploadimg_file_error'),$this->Lang_Get('error'));
                return;
            }
        } elseif (isPost('img_url') && $_REQUEST['img_url']!='' && $_REQUEST['img_url']!='http://') {
            /**
             * Загрузка файла по URl
             */
            $sFile=$this->Topic_UploadTopicImageUrl($_REQUEST['img_url'],$this->oUserCurrent);
            switch (true) {
                case is_string($sFile):

                    break;

                case ($sFile==ModuleImage::UPLOAD_IMAGE_ERROR_READ):
                    $this->Message_AddErrorSingle($this->Lang_Get('uploadimg_url_error_read'),$this->Lang_Get('error'));
                    return;

                case ($sFile==ModuleImage::UPLOAD_IMAGE_ERROR_SIZE):
                    $this->Message_AddErrorSingle($this->Lang_Get('uploadimg_url_error_size'),$this->Lang_Get('error'));
                    return;

                case ($sFile==ModuleImage::UPLOAD_IMAGE_ERROR_TYPE):
                    $this->Message_AddErrorSingle($this->Lang_Get('uploadimg_url_error_type'),$this->Lang_Get('error'));
                    return;

                default:
                case ($sFile==ModuleImage::UPLOAD_IMAGE_ERROR):
                    $this->Message_AddErrorSingle($this->Lang_Get('uploadimg_url_error'),$this->Lang_Get('error'));
                    return;
            }
        }
        /**
         * Если файл успешно загружен, формируем HTML вставки и возвращаем в ajax ответе
         */
        if ($sFile) {
            $sText=$this->Image_BuildHTML($sFile, $_REQUEST);
            $this->Viewer_AssignAjax('sText',$sText);
            $this->Viewer_AssignAjax('sFile',$sFile);
        }
    }
}