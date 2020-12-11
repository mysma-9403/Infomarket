<?php
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel {

	public function registerBundles() {
		$bundles = [new Symfony\Bundle\FrameworkBundle\FrameworkBundle(), 
				new Symfony\Bundle\SecurityBundle\SecurityBundle(), new Symfony\Bundle\TwigBundle\TwigBundle(), 
				new Symfony\Bundle\MonologBundle\MonologBundle(), 
				new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(), 
				new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(), 
				new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(), 
				new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(), 
				new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(), new FOS\UserBundle\FOSUserBundle(),
				new \FOS\CKEditorBundle\FOSCKEditorBundle(),
                new FM\ElfinderBundle\FMElfinderBundle(),
				new AppBundle\AppBundle(),
                new Http\HttplugBundle\HttplugBundle(),
				new Happyr\GoogleAnalyticsBundle\HappyrGoogleAnalyticsBundle(), 
				new CMEN\GoogleChartsBundle\CMENGoogleChartsBundle(),
				new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
                new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle()];
		
		if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
			$bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
			$bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
			//$bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
			//$bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
			$bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
		}
		
		return $bundles;
	}

	public function getRootDir() {
		return __DIR__;
	}

	public function getCacheDir() {
		return dirname(__DIR__) . '/var/cache/' . $this->getEnvironment();
	}

	public function getLogDir() {
		return dirname(__DIR__) . '/var/logs';
	}

	public function registerContainerConfiguration(LoaderInterface $loader) {
		$loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
	}
}
