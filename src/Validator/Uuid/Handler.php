<?php

namespace App\Validator\Uuid;

use App\Validator\RelatedRequired\RelatedRequired;
use Yiisoft\Validator\Exception\UnexpectedRuleException;
use Yiisoft\Validator\Result;
use Yiisoft\Validator\RuleHandlerInterface;
use Yiisoft\Validator\RuleInterface;
use Yiisoft\Validator\ValidationContext;

class Handler implements RuleHandlerInterface {
    private const string PATTERN = '\A[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}\z';
    private const string NIL = '00000000-0000-0000-0000-000000000000';

    /**
     * @param mixed $value
     * @param RuleInterface $rule
     * @param ValidationContext $context
     * @return Result
     */
    public function validate(mixed $value, RuleInterface $rule, ValidationContext $context): Result {
        if (!$rule instanceof Uuid) {
            throw new UnexpectedRuleException(RelatedRequired::class, $rule);
        }

        $result = new Result();

        if ($this->validateUuid($value)) {
            return $result;
        }

        if ($context->isPropertyMissing()) {
            return $result->addError($rule->getNotPassedMessage(), [
                'property' => $context->getTranslatedProperty(),
                'Property' => $context->getCapitalizedTranslatedProperty(),
            ]);
        }

        return $result->addError($rule->getMessage(), [
            'property' => $context->getTranslatedProperty(),
            'Property' => $context->getCapitalizedTranslatedProperty(),
        ]);
    }

    /**
     * @param string $uuid
     * @return bool
     */
    protected function validateUuid(string $uuid): bool {
        $uuid = str_replace(['urn:', 'uuid:', 'URN:', 'UUID:', '{', '}'], '', $uuid);

        return $uuid === self::NIL || preg_match('/' . self::PATTERN . '/Dms', $uuid);
    }
}
