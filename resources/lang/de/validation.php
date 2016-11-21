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

    // Todo: translate

    'accepted'             => 'Das :attribute muss akzeptiert werden.',
    'active_url'           => 'Das :attribute ist keine gültige URL.',
    'after'                => 'Das :attribute muss ein Datum nach dem :date sein.',
    'alpha'                => 'Das :attribute sollte nur Buchstaben beinhalten.',
    'alpha_dash'           => 'Das :attribute soltte nur Buchstaben, Zahlen und Gedankenstriche beinhalten.',
    'alpha_num'            => 'Das :attribute sollte nur Buchstaben und Zahlen beinhalten.',
    'array'                => 'Das :attribute muss ein Array sein.',
    'before'               => 'Das :attribute muss eine Datum vor dem :date sein.',
    'between'              => [
        'numeric' => 'Das :attribute sollte zwischen :min und :max sein.',
        'file'    => 'Das :attribute sollte eine Größe von :min bis :max kilobytes haben.',
        'string'  => 'Das :attribute sollte eine Größe von :min bis :max Zeichen haben.',
        'array'   => 'Das :attribute sollte :min bis :max Items beinhalten.',
    ],
    'boolean'              => 'Das :attribute Feld muss wahr oder falsch sein.',
    'confirmed'            => 'Die :attribute Bestätigung stimmt nicht überein.',
    'date'                 => 'Das :attribute ist kein gültiges Datum.',
    'date_format'          => 'Das :attribute stimmt nicht mit dem Format: :format überein.',
    'different'            => 'Das :attribute und :other müssen sich unterscheiden.',
    'digits'               => 'Das :attribute müssen :digits Zahlen sein.',
    'digits_between'       => 'Das :attribute müssen Zahlen zwischen :min and :max sein.',
    'dimensions'           => 'Das :attribute hat ungültige Imageformat Größe (Dimensionen).',
    'distinct'             => 'Das :attribute Feld hat einen doppelten Eintrag.',
    'email'                => 'Das :attribute muss eine zulässige Email Adresse sein.',
    'exists'               => 'Das ausgewählte :attribute ist ungültig.',
    'file'                 => 'Das :attribute muss eine Datei sein.',
    'filled'               => 'Das :attribute Feld ist erforderlich.',
    'image'                => 'Das :attribute muss ein Bild sein.',
    'in'                   => 'Das ausgewählte :attribute ist ungültig.',
    'in_array'             => 'Das :attribute Feld existiert nicht in :other.',
    'integer'              => 'Das :attribute muss eine Integerzahl sein.',
    'ip'                   => 'Das :attribute muss eine gültige IP Addresse sein.',
    'json'                 => 'Das :attribute muss eine gültiger JSON String sein.',
    'max'                  => [
        'numeric' => 'Das :attribute darf nicht größer sein als :max.',
        'file'    => 'Das :attribute darf nicht größer sein als :max kilobytes.',
        'string'  => 'Das :attribute darf nicht größer sein als :max Zeichen.',
        'array'   => 'Das :attribute darf nicht mehr als :max Items besitzen.',
    ],
    'mimes'                => 'Das :attribute muss ein File vom Typ: :values sein.',
    'mimetypes'            => 'Das :attribute muss ein File vom Typ: :values sein.',
    'min'                  => [
        'numeric' => 'Das :attribute muss mindestes :min sein.',
        'file'    => 'Das :attribute muss mindestes :min kilobytes haben.',
        'string'  => 'Das :attribute muss mindestes :min Zeichen lang sein.',
        'array'   => 'Das :attribute muss mindestes :min Items beinhalten.',
    ],
    'not_in'               => 'Das ausgewählte :attribute ist nicht gültig.',
    'numeric'              => 'Das :attribute muss eine Nummer sein.',
    'present'              => 'Das :attribute Feld muss vorhanden sein.',
    'regex'                => 'Das :attribute Format ist nicht gültig.',
    'required'             => 'Das :attribute Feld ist erforderlich.',
    'required_if'          => 'Das :attribute Feld ist erforderlich wenn :other den Wert :value hat.',
    'required_unless'      => 'Das :attribute Feld ist erforderlich, es sei denn :other hat einen der Werte :values.',
    'required_with'        => 'Das :attribute Feld ist erforderlich wenn :values vorhanden ist.',
    'required_with_all'    => 'Das :attribute Feld ist erforderlich wenn :values vorhanden sind.',
    'required_without'     => 'Das :attribute Feld ist erforderlich wenn :values nicht vorhanden ist.',
    'required_without_all' => 'Das :attribute Feld ist erforderlich wenn keiner der folgenden :values vorhanden sind.',
    'same'                 => 'Das :attribute und :other müssen zusammen passen.',
    'size'                 => [
        'numeric' => 'Das :attribute muss :size groß sein.',
        'file'    => 'Das :attribute muss die Größe von :size kilobytes haben.',
        'string'  => 'Das :attribute muss :size Zeichen lang sein.',
        'array'   => 'Das :attribute muss :size Items beinhalten.',
    ],
    'string'               => 'Das :attribute muss eine String sein.',
    'timezone'             => 'Das :attribute muss einer gültige Zeitzone entsprechen.',
    'unique'               => 'Das :attribute ist schon vergeben.',
    'uploaded'             => 'Das :attribute ist fehlgeschlagen.',
    'url'                  => 'Das :attribute ist nicht im richtigen Format.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'password' => 'Passwort',
        'runtime_to' => 'Programmlaufzeitende',
        'runtime_from' => 'Programmlaufzeitstart',
        'name' => 'Name'
    ],

];