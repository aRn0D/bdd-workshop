<?php

namespace spec\AppBundle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AppBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\AppBundle');
    }

    function it_is_a_bundle()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\Bundle\Bundle');
    }

    function it_adds_compiler_pass(ContainerBuilder $container)
    {
        $container->addCompilerPass(
            Argument::type('AppBundle\DependencyInjection\Compiler\RegisterRulePass')
        );

        $this->build($container);
    }
}
