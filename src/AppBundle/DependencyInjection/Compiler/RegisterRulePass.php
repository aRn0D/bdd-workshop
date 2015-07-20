<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RegisterRulePass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('rule.registry')) {
            return;
        }

        $blockRegistry = $container->getDefinition('rule.registry');
        $taggedServices = $container->findTaggedServiceIds('rule.rewriter');

        foreach ($taggedServices as $id => $name) {
            $blockRegistry->addMethodCall('register', array(
                $name[0]['alias'],
                new Reference($id),
            ));
        }
    }
}
