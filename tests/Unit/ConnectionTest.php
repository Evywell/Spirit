<?php


namespace Spirit\Test;


use PHPUnit\Framework\TestCase;
use Spirit\Connection;
use Spirit\Exception\SpiritConnectionException;
use Spirit\Settings;
use Spirit\Test\Driver\SimpleDriver;

class ConnectionTest extends TestCase
{

    public function testSimpleConnectionObject(): void
    {
        $settings = new Settings();
        $settings->setDrivers([
            'simple' => SimpleDriver::class
        ]);
        $parameters = ['driver' => 'simple'];

        $this->assertInstanceOf(Connection::class, Connection::create($settings, $parameters));
    }

    public function testCreateConnectionWithoutDriverParameter(): void
    {
        $this->expectExceptionMessage("Vous devez spécifier un driver dans les paramètre de connexion !");
        $this->expectException(SpiritConnectionException::class);
        Connection::create(new Settings(), []);
    }

    public function testCreateConnectionWithUnknownDriver(): void
    {
        $this->expectExceptionMessage("Le driver unknown n'a pas été trouvé. L'avez-vous enregistré via Spirit\Settings::registerDriver() ?");
        $this->expectException(SpiritConnectionException::class);
        Connection::create(new Settings(), ['driver' => 'unknown']);
    }

    public function testCreateConnectionWithNotDefinedDriver(): void
    {
        $settings = new Settings();
        $settings->setDrivers(['simple' => SimpleDriver::class]);
        $this->expectExceptionMessage("Le driver driver_name n'a pas été trouvé. L'avez-vous enregistré via Spirit\Settings::registerDriver() ?");
        $this->expectException(SpiritConnectionException::class);
        Connection::create($settings, ['driver' => 'driver_name']);
    }

    public function testCreateConnectionWithANotDriverClassAsDriver(): void
    {
        $settings = new Settings();
        $settings->setDrivers(['simple' => \stdClass::class]);
        $this->expectExceptionMessage(
            sprintf(
                "La classe %s n'est pas un driver valide ! %s doit implémenter l'interface Spirit\Driver\DriverInterface",
                \stdClass::class,
                \stdClass::class
            )
        );
        $this->expectException(SpiritConnectionException::class);
        Connection::create($settings, ['driver' => 'simple']);
    }

}