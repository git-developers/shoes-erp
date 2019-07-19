<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Tests\Command;

use Bundle\ResourceBundle\Command\DebugResourceCommand;
use Component\Resource\Metadata\Metadata;
use Component\Resource\Metadata\MetadataInterface;
use Component\Resource\Metadata\RegistryInterface;
use Symfony\Component\Console\Tester\CommandTester;

final class DebugResourceCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RegistryInterface
     */
    private $registry;

    /**
     * @var CommandTester
     */
    private $tester;

    public function setUp(): void
    {
        $this->registry = $this->prophesize(RegistryInterface::class);

        $command = new DebugResourceCommand($this->registry->reveal());
        $this->tester = new CommandTester($command);
    }

    /**
     * @test
     */
    public function it_lists_all_resources_if_no_argument_is_given(): void
    {
        $this->registry->getAll()->willReturn([$this->createMetadata('one'), $this->createMetadata('two')]);
        $this->tester->execute([]);
        $display = $this->tester->getDisplay();

        $this->assertEquals(<<<'EOT'
+------------+
| Alias      |
+------------+
| sylius.one |
| sylius.two |
+------------+

EOT
        , $display);
    }

    /**
     * @test
     */
    public function it_displays_the_metadata_for_given_resource_alias(): void
    {
        $this->registry->get('metadata.one')->willReturn($this->createMetadata('one'));
        $this->tester->execute([
            'resource' => 'metadata.one',
        ]);

        $display = $this->tester->getDisplay();

        $this->assertEquals(<<<'EOT'
+------------------------------+-----------------+
| name                         | one             |
| application                  | sylius          |
| driver                       | doctrine/foobar |
| classes.foo                  | bar             |
| classes.bar                  | foo             |
| whatever.something.elephants | camels          |
+------------------------------+-----------------+

EOT
        , $display);
    }

    /**
     * @param string $suffix
     *
     * @return MetadataInterface
     */
    private function createMetadata(string $suffix): MetadataInterface
    {
        $metadata = Metadata::fromAliasAndConfiguration(sprintf('sylius.%s', $suffix), [
            'driver' => 'doctrine/foobar',
            'classes' => [
                'foo' => 'bar',
                'bar' => 'foo',
            ],
            'whatever' => [
                'something' => [
                    'elephants' => 'camels',
                ],
            ],
        ]);

        return $metadata;
    }
}
