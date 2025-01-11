<?php

namespace App\Validator\RelatedRequired;

use Yiisoft\Validator\EmptyCondition\WhenEmpty;
use Yiisoft\Validator\Exception\UnexpectedRuleException;
use Yiisoft\Validator\Result;
use Yiisoft\Validator\RuleHandlerInterface;
use Yiisoft\Validator\RuleInterface;
use Yiisoft\Validator\ValidationContext;

class Handler implements RuleHandlerInterface {
    private $defaultEmptyCondition;

    /**
     * @param callable|null $defaultEmptyCondition
     */
    public function __construct(
        callable|null $defaultEmptyCondition = null,
    ) {
        $this->defaultEmptyCondition = $defaultEmptyCondition ?? new WhenEmpty(trimString: true);
    }

    /**
     * @param mixed $value
     * @param RuleInterface $rule
     * @param ValidationContext $context
     * @return Result
     */
    public function validate(mixed $value, RuleInterface $rule, ValidationContext $context): Result {
        if (!$rule instanceof RelatedRequired) {
            throw new UnexpectedRuleException(RelatedRequired::class, $rule);
        }

        $result = new Result();

        if ($context->getDataSet()->getPropertyValue($rule->getProperty()) !== $rule->getValue()) {
            return $result;
        }

        if ($context->isPropertyMissing()) {
            $result->addError($rule->getNotPassedMessage(), [
                'property' => $context->getTranslatedProperty(),
                'Property' => $context->getCapitalizedTranslatedProperty(),
            ]);

            return $result;
        }

        $emptyCondition = $rule->getEmptyCondition() ?? $this->defaultEmptyCondition;

        if (!$emptyCondition($value, $context->isPropertyMissing())) {
            return $result;
        }

        $result->addError($rule->getMessage(), [
            'property' => $context->getTranslatedProperty(),
            'Property' => $context->getCapitalizedTranslatedProperty(),
        ]);

        return $result;
    }
}
