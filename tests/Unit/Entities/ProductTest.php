<?php
//ProductTest.php
namespace Tests\Unit\Entities;

use PHPUnit\Framework\TestCase;
use App\Entities\Product;

class ProductTest extends TestCase
{
    private Product $product;

    protected function setUp(): void
    {
        $this->product = new Product('Laptop', 1500.99);
    }

    public function testConstructorSetsNameAndPrice(): void
    {
        $this->assertSame('Laptop', $this->product->getName());
        $this->assertSame(1500.99, $this->product->getPrice());
        $this->assertNull($this->product->getId());
    }

    public function testSetAndGetId(): void
    {
        $this->product->setId(789);
        $this->assertSame(789, $this->product->getId());
    }

    public function testSetAndGetName(): void
    {
        $this->product->setName('Desktop');
        $this->assertSame('Desktop', $this->product->getName());
    }

    public function testSetAndGetPrice(): void
    {
        $this->product->setPrice(2000.50);
        $this->assertSame(2000.50, $this->product->getPrice());
    }

    public function testToArrayReturnsCorrectFormat(): void
    {
        $this->product->setId(101);

        $expected = [
            'id'    => 101,
            'name'  => 'Laptop',
            'price' => 1500.99,
        ];

        $this->assertSame($expected, $this->product->toArray());
    }

    public function testZeroPriceIsValid(): void
    {
        $freeProduct = new Product('Free Sample', 0.0);
        $this->assertSame(0.0, $freeProduct->getPrice());
    }

    public function testEmptyConstructor(): void
    {
        $emptyProduct = new Product();
        $this->assertSame('', $emptyProduct->getName());
        $this->assertSame(0.0, $emptyProduct->getPrice());
    }
}
