<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Атрибут :attribute повинні бути дозволеним.',
    'active_url' => 'Атрибут :attribute повинен бути URL адресою.',
    'after' => 'Атрибут :attribute повинна бути дата після :date.',
    'after_or_equal' => 'Атрибут :attribute повинна бути дата після або рівна даті :date.',
    'alpha' => 'Атрибут :attribute може містити лише літери.',
    'alpha_dash' => 'Атрибут :attribute може містити лише літери, цифри, тире та підкреслення.',
    'alpha_num' => 'Атрибут :attribute може містити лише літери та цифри.',
    'array' => 'Атрибут :attribute повинен бути масивом.',
    'before' => 'Атрибут :attribute повинна бути датою до :date.',
    'before_or_equal' => 'Атрибут :attribute має бути дата до або рівна даті :date.',
    'between' => [
        'numeric' => 'Атрибут :attribute має бути між :min та :max.',
        'file' => 'Атрибут :attribute має бути між :min та :max кілобайт.',
        'string' => 'Атрибут :attribute має бути між :min та :max символів.',
        'array' => 'Атрибут :attribute має бути між :min та :max елементів.',
    ],
    'boolean' => 'Атрибут :attribute має бути істинним або хибним.',
    'confirmed' => 'Атрибут :attribute не підтверджений.',
    'date' => 'Атрибут :attribute не є дійсною датою.',
    'date_equals' => 'Атрибут :attribute має бути дата, рівна :date.',
    'date_format' => 'Атрибут :attribute не відповідає формату :format.',
    'different' => 'Атрибут :attribute та :other повинні бути різними.',
    'digits' => 'Атрибут :attribute повинен бути :digits числами.',
    'digits_between' => 'Атрибут :attribute має бути між :min та :max числами.',
    'dimensions' => 'Атрибут :attribute має недійсні розміри зображення.',
    'distinct' => 'Атрибут :attribute має повторюване значення.',
    'email' => 'Атрибут :attribute має бути дійсною електронною адресою.',
    'ends_with' => 'Атрибут :attribute повинен закінчуватися одним із наступних: :values.',
    'exists' => 'Атрибут :attribute недійсний.',
    'file' => 'Атрибут :attribute має бути файлом.',
    'filled' => 'Атрибут :attribute повинен мати значення.',
    'gt' => [
        'numeric' => 'Атрибут :attribute має бути більше :value.',
        'file' => 'Атрибут :attribute має бути більше :value кілобайт.',
        'string' => 'Атрибут :attribute має бути більше :value символів.',
        'array' => 'Атрибут :attribute повинен мати більше ніж :value елементів.',
    ],
    'gte' => [
        'numeric' => 'Атрибут :attribute має бути більшим або рівним :value.',
        'file' => 'Атрибут :attribute має бути більшим або рівним :value кілобайт.',
        'string' => 'Атрибут :attribute має бути більшим або рівним :value символів.',
        'array' => 'Атрибут :attribute повинен містити :value елементів або більше.',
    ],
    'image' => 'Атрибут :attribute має бути зображення.',
    'in' => 'Атрибут :attribute є недійсним.',
    'in_array' => 'Атрибут :attribute не існує в :other.',
    'integer' => 'Атрибут :attribute має бути цілим числом.',
    'ip' => 'Атрибут :attribute має бути дійсною IP-адресою.',
    'ipv4' => 'Атрибут :attribute має бути дійсною адресою IPv4.',
    'ipv6' => 'Атрибут :attribute має бути дійсною адресою IPv6.',
    'json' => 'Атрибут :attribute має бути дійсним рядком JSON.',
    'lt' => [
        'numeric' => 'Атрибут :attribute має бути менше :value.',
        'file' => 'Атрибут :attributeмає бути менше :value кілобайт.',
        'string' => 'Атрибут :attribute має бути менше :value символів.',
        'array' => 'Атрибут :attribute має бути менше :value елементів.',
    ],
    'lte' => [
        'numeric' => 'Атрибут :attribute має бути меншим або рівним :value.',
        'file' => 'Атрибут :attribute має бути меншим або рівним :value кілобайт.',
        'string' => 'Атрибут :attribute має бути меншим або рівним :value символів.',
        'array' => 'Атрибут :attribute не повинен мати більше :value елементів.',
    ],
    'max' => [
        'numeric' => 'Атрибут :attribute може бути не більшим :max.',
        'file' => 'Атрибут :attribute may може бути не більшим :max кілобайт.',
        'string' => 'Атрибут :attribute may не може мати більше ніж :max символів.',
        'array' => 'Атрибут :attribute не може мати більше ніж :max елементів.',
    ],
    'mimes' => 'Атрибут :attribute повинен бути файлом типу: :values.',
    'mimetypes' => 'Атрибут :attribute повинен бути файлом типу: :values.',
    'min' => [
        'numeric' => 'Атрибут :attribute має бути принаймні :min.',
        'file' => 'Атрибут :attribute be at least :min кілобайт.',
        'string' => 'Атрибут :attribute повинно містити принаймні :min символів.',
        'array' => 'Атрибут :attribute повинно містити принаймні :min елементів.',
    ],
    'multiple_of' => 'Атрибут :attribute має бути кратним :value',
    'not_in' => 'Атрибут :attribute недійсний.',
    'not_regex' => 'Атрибут :attribute має недійсний формат.',
    'numeric' => 'Атрибут :attribute має бути числом.',
    'password' => 'Пароль неправильний.',
    'present' => 'Атрибут :attribute повинен бути.',
    'regex' => 'Атрибут :attribute має недійсний формат.',
    'required' => 'Атрибут :attribute обов’язковий.',
    'required_if' => 'Атрибут :attribute обов’язковий, коли :other є :value.',
    'required_unless' => 'Атрибут :attribute обов’язковий, якщо не вказано що :other є в :values.',
    'required_with' => 'Атрибут :attribute обов’язковий, коли :values існує.',
    'required_with_all' => 'Атрибут :attribute обов’язковий, коли :values існують.',
    'required_without' => 'Атрибут :attribute обов’язковий, коли :values не існує.',
    'required_without_all' => 'Атрибут :attribute обов’язковий, коли жодне з :values не існує.',
    'same' => 'Атрибут :attribute і :other повинні відповідати.',
    'size' => [
        'numeric' => 'Атрибут :attribute повинен бути :size.',
        'file' => 'Атрибут :attribute повинен бути :size кілобайт.',
        'string' => 'Атрибут :attribute повинен бути :size символів.',
        'array' => 'Атрибут :attribute повинен містити :size елементів.',
    ],
    'starts_with' => 'Атрибут :attribute повинен починатися з одним з наступних: :values.',
    'string' => 'Атрибут :attribute повинен бути рядком.',
    'timezone' => 'Атрибут :attribute повинен бути дійсною часовою зоною.',
    'unique' => 'Атрибут :attribute повинен бути унікальним.',
    'uploaded' => 'Атрибут :attribute помилка при загрузці.',
    'url' => 'Атрибут :attribute має помилку в форматі.',
    'uuid' => 'Атрибут :attribute повинен мати формат UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
