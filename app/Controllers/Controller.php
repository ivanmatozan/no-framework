<?php

namespace App\Controllers;

use App\Exceptions\ValidationException;
use Psr\Http\Message\ServerRequestInterface;
use Valitron\Validator;

abstract class Controller
{
    /**
     * @param ServerRequestInterface $request
     * @param array $rules
     * @return array|object|null
     * @throws ValidationException
     */
    public function validate(ServerRequestInterface $request, array $rules)
    {
        $validator = new Validator($request->getParsedBody());
        $validator->mapFieldsRules($rules);

        if (!$validator->validate()) {
            throw new ValidationException($request, $validator->errors());
        }

        return $request->getParsedBody();
    }
}
