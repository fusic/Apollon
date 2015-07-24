<?php

namespace Apollon\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Event\Event;
use Cake\Validation\Validator;

class ApollonBehavior extends Behavior
{
    /**
     * バリデーター初期化イベント
     *
     * @access public
     * @author sakuragawa
    */
    public function buildValidator(Event $event, Validator $validator, $name)
    {
        // ここで自作をしたproviderを追加してあげます。
        $validator->provider('default', 'Apollon\Validation\ApollonValidation');

        return $validator;
    }

    /**
    * イベント設定
    *
    * @access public
    * @author sakuragawa
    */
    public function implementedEvents()
    {
        $events = parent::implementedEvents();

        // buildValidatorを登録
        $events['Model.buildValidator'] = 'buildValidator';
        return $events;
    }
}
