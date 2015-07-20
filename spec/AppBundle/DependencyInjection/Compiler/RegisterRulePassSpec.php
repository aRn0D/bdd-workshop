<?php

namespace spec\AppBundle\DependencyInjection\Compiler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class RegisterRulePassSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\DependencyInjection\Compiler\RegisterRulePass');
    }

    function it_is_a_compileur_pass()
    {
        $this->shouldImplement('Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface');
    }

    function it_registers_the_blocks(ContainerBuilder $container, Definition $blockRegistry)
    {
        $container->hasDefinition('rule.registry')->willReturn(true);
        $container->getDefinition('rule.registry')->willReturn($blockRegistry);

        $container->findTaggedServiceIds('rule.rewriter')->willReturn(['block.id' => [['alias' => 'tag.name']]]);
        $blockRegistry->addMethodCall('register', array(
            'tag.name',
            Argument::type('Symfony\Component\DependencyInjection\Reference'),
        ));

        $this->process($container);
    }
}
