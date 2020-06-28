<?php
use PHPUnit\Framework\TestCase;

final class ResenaTest extends TestCase
{
    public function testCanBeCreatedFromValidArray(): void
    {
            $array["trabajador_id"] = 1;
            $array["quien_resena_id"] = 2;
            $array["texto"] = "asd texto";
            $array["evaluacion"] = 5;
            $array["imagenes"] = '["78a43646e7149ea8c6f42983f20992e71593243673.jpg", "3b780993496120d4ae3710b9124672b01593243673.jpg"]';

        $this->assertInstanceOf(
            Resena::class,
            Resena::fromArray($array)
        );
    }

    public function testCannotBeCreatedFromInvalidArray(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Resena::fromArray('invalid');
    }

    public function testCanBeUsedAsArray(): void
    {
        $array["trabajador_id"] = 1;
        $array["quien_resena_id"] = 2;
        $array["texto"] = "asd texto";
        $array["evaluacion"] = 5;
        $array["imagenes"] = '["78a43646e7149ea8c6f42983f20992e71593243673.jpg", "3b780993496120d4ae3710b9124672b01593243673.jpg"]';

        $this->assertEquals(
            'asd texto',
            Resena::fromArray($array)
        );
    }
}


