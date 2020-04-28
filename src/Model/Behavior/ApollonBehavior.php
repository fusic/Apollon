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
     * @param Event $event
     * @param Validator $validator
     * @param string $name
     * @return Validator
     */
    public function buildValidator(Event $event, Validator $validator, $name): Validator
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
     * @return array
     */
    public function implementedEvents(): array
    {
        $events = parent::implementedEvents();

        // buildValidatorを登録
        $events['Model.buildValidator'] = 'buildValidator';
        return $events;
    }
}
