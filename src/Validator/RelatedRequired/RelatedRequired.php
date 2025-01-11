<?php

namespace App\Validator\RelatedRequired;

use Attribute;
use Closure;
use Yiisoft\Validator\DumpedRuleInterface;
use Yiisoft\Validator\Rule\Trait\SkipOnErrorTrait;
use Yiisoft\Validator\Rule\Trait\WhenTrait;
use Yiisoft\Validator\SkipOnErrorInterface;
use Yiisoft\Validator\WhenInterface;

/**
 * @psalm-type EmptyConditionType = callable(mixed,bool):bool
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class RelatedRequired implements DumpedRuleInterface, SkipOnErrorInterface, WhenInterface {
    use SkipOnErrorTrait;
    use WhenTrait;

    private $emptyCondition;

    /**
     * @param string $property
     * @param mixed $value
     * @param string $message
     * @param string $notPassedMessage
     * @param callable|null $emptyCondition
     * @param bool $skipOnError
     * @param Closure|null $when
     */
    public function __construct(
        private readonly string       $property,
        private readonly mixed        $value,
        private readonly string       $message = '{Property} cannot be blank.',
        private readonly string       $notPassedMessage = '{Property} not passed.',
        callable|null                 $emptyCondition = null,
        private readonly bool         $skipOnError = false,
        private readonly Closure|null $when = null,
    ) {
        $this->emptyCondition = $emptyCondition;
    }

    /**
     * @return string
     */
    public function getProperty(): string {
        return $this->property;
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed {
        return $this->value;
    }

    /**
     * Gets error message used when validation fails because the validated value is empty.
     *
     * @return string Error message / template.
     *
     * @see $message
     */
    public function getMessage(): string {
        return $this->message;
    }

    /**
     * Gets error message used when validation fails because the validated value is not passed.
     *
     * @return string Error message / template.
     *
     * @see $message
     */
    public function getNotPassedMessage(): string {
        return $this->notPassedMessage;
    }

    /**
     * Gets empty condition used to determine emptiness of the value.
     *
     * @return callable|null Empty condition.
     *
     * @psalm-return EmptyConditionType|null
     *
     * @see $emptyCondition
     */
    public function getEmptyCondition(): ?callable {
        return $this->emptyCondition;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return self::class;
    }

    /**
     * @return array
     */
    public function getOptions(): array {
        return [];
    }

    /**
     * @return string
     */
    public function getHandler(): string {
        return Handler::class;
    }
}
