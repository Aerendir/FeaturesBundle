<?php

namespace SerendipityHQ\Bundle\FeaturesBundle\DependencyInjection;

use SerendipityHQ\Bundle\FeaturesBundle\InvoiceDrawer\PlainTextDrawer;
use SerendipityHQ\Bundle\FeaturesBundle\Service\FeaturesManager;
use SerendipityHQ\Bundle\FeaturesBundle\Service\InvoicesManager;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * {@inheritdoc}
 */
class FeaturesExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        //die(VarDumper::dump($config));

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        // Create services for drawers
        foreach ($config['invoices']['drawers'] as $drawer) {
            $this->createFormatterService($drawer, $container);
        }

        // Create services for features
        foreach ($config['sets'] as $creatingSetName => $setConfig) {
            $this->createFeaturesService($creatingSetName, $setConfig, $container);
            $this->createInvoicesService($creatingSetName, $setConfig, $container);
        }
    }

    /**
     * @param string $drawer
     * @param ContainerBuilder $containerBuilder
     */
    private function createFormatterService(string $drawer, ContainerBuilder $containerBuilder)
    {
        $drawerServiceName = null;
        $drawerDefinition = null;
        // Create the drawer definition
        switch ($drawer) {
            case 'plain_text':
                $drawerDefinition = new Definition(PlainTextDrawer::class);
                $drawerServiceName = 'shq_features.drawer.plain_text';
                break;
        }

        $drawerDefinition->addTag('shq_features.invoice_drawer');
        $containerBuilder->setDefinition($drawerServiceName, $drawerDefinition);
    }

    /**
     * @param string           $name
     * @param array            $setConfig
     * @param ContainerBuilder $containerBuilder
     */
    private function createFeaturesService(string $name, array $setConfig, ContainerBuilder $containerBuilder)
    {
        // Create the feature manager definition
        $featureManagerDefinition = new Definition(FeaturesManager::class, [$setConfig['features']]);
        $serviceName = 'shq_features.manager.'.$name.'.features';
        $featureManagerDefinition->addTag('shq_features.feature_manager');
        $containerBuilder->setDefinition($serviceName, $featureManagerDefinition);
    }

    /**
     * @param string           $name
     * @param array            $setConfig
     * @param ContainerBuilder $containerBuilder
     */
    private function createInvoicesService(string $name, array $setConfig, ContainerBuilder $containerBuilder)
    {
        $arrayWriterDefinition = $containerBuilder->findDefinition('shq_features.array_writer');
        $defaultDrawer = $setConfig['default_drawer'] ?? null;
        $invoicesManagerDefinition = new Definition(InvoicesManager::class, [$setConfig['features'], $arrayWriterDefinition, $defaultDrawer]);
        $serviceName = 'shq_features.manager.'.$name.'.invoices';
        $invoicesManagerDefinition->addTag('shq_features.invoice_manager');
        $containerBuilder->setDefinition($serviceName, $invoicesManagerDefinition);
    }
}
