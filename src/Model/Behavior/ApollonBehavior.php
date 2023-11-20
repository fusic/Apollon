<?php
declare(strict_types=1);

namespace Apollon\Model\Behavior;

use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\Validation\Validator;

class ApollonBehavior extends Behavior
{
    /**
     * バリデーター初期化イベント
     *
     * @param \Cake\Event\EventInterface $event
     * @param \Cake\Validation\Validator $validator
     * @param string $name
     * @return \Cake\Validation\Validator
     */
    public function buildValidator(EventInterface $event, Validator $validator, string $name): Validator
    {
        // ここで自作をしたproviderを追加してあげます。
        $validator->setProvider('default', 'Apollon\Validation\ApollonValidation');

        return $validator;
    }

    /**
     * イベント設定
     *
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
