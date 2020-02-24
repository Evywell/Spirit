<?php


namespace Spirit\Exception;


class SpiritException
{

    public static function noDriverSpecified(): SpiritConnectionException
    {
        return new SpiritConnectionException("Vous devez spécifier un driver dans les paramètre de connexion !");
    }

    public static function unknownDriver(string $driverName): SpiritConnectionException
    {
        return new SpiritConnectionException(
            sprintf(
                "Le driver %s n'a pas été trouvé. L'avez-vous enregistré via Spirit\Settings::registerDriver() ?",
                $driverName
            )
        );
    }

    public static function notADriver(string $driverClass): SpiritConnectionException
    {
        return new SpiritConnectionException(
            sprintf(
                "La classe %s n'est pas un driver valide ! %s doit implémenter l'interface Spirit\Driver\DriverInterface",
                $driverClass,
                $driverClass
            )
        );
    }

}