<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Phinx\Console\Command;

use InvalidArgumentException;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Init extends Command
{
    const FILE_NAME = 'phinx';

    /**
     * @var string
     */
    protected static $defaultName = 'init';

    /**
     * {@inheritDoc}
     *
     * @return void
     */
    protected function configure()
    {
        $this->setDescription('Initialize the application for Phinx')
            ->addOption('--format', '-f', InputArgument::OPTIONAL, 'What format should we use to initialize?', 'yml')
            ->addArgument('path', InputArgument::OPTIONAL, 'Which path should we initialize for Phinx?')
            ->setHelp(sprintf(
                '%sInitializes the application for Phinx%s',
                PHP_EOL,
                PHP_EOL
            ));
    }

    /**
     * Initializes the application.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input Interface implemented by all input classes.
     * @param \Symfony\Component\Console\Output\OutputInterface $output Interface implemented by all output classes.
     *
     * @return int 0 on success
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $this->resolvePath($input);
        $format = strtolower($input->getOption('format'));
        $this->writeConfig($path, $format);

        $output->writeln("<info>created</info> {$path}");

        return 0;
    }

    /**
     * Return valid $path for Phinx's config file.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input Interface implemented by all input classes.
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    protected function resolvePath(InputInterface $input)
    {
        // get the migration path from the config
        $path = (string)$input->getArgument('path');

        $format = strtolower($input->getOption('format'));
        if (!in_array($format, ['yml', 'json', 'php'])) {
            throw new InvalidArgumentException(sprintf(
                'Invalid format "%s". Format must be either yml, json, or php.',
                $format
            ));
        }

        // Fallback
        if (!$path) {
            $path = getcwd() . DIRECTORY_SEPARATOR . self::FILE_NAME . '.' . $format;
        }

        // Adding file name if necessary
        if (is_dir($path)) {
            $path .= DIRECTORY_SEPARATOR . self::FILE_NAME . '.' . $format;
        }

        // Check if path is available
        $dirname = dirname($path);
        if (is_dir($dirname) && !is_file($path)) {
            return $path;
        }

        // Path is valid, but file already exists
        if (is_file($path)) {
            throw new InvalidArgumentException(sprintf(
                'Config file "%s" already exists.',
                $path
            ));
        }

        // Dir is invalid
        throw new InvalidArgumentException(sprintf(
            'Invalid path "%s" for config file.',
            $path
        ));
    }

    /**
     * Writes Phinx's config in provided $path
     *
     * @param string $path Config file's path.
     * @param string $format Format to use for config file
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     *
     * @return void
     */
    protected function writeConfig($path, $format = 'yml')
    {
        // Check if dir is writable
        $dirname = dirname($path);
        if (!is_writable($dirname)) {
            throw new InvalidArgumentException(sprintf(
                'The directory "%s" is not writable',
                $dirname
            ));
        }

        // load the config template
        if (is_dir(__DIR__ . '/../../../data/Phinx')) {
            $contents = file_get_contents(__DIR__ . '/../../../data/Phinx/' . self::FILE_NAME . '.' . $format . '.dist');
        } elseif ($format === 'yml') {
            $contents = file_get_contents(__DIR__ . '/../../../../' . self::FILE_NAME . '.' . $format);
        } else {
            throw new RuntimeException(sprintf(
                'Could not find template for format "%s".',
                $format
            ));
        }

        if (file_put_contents($path, $contents) === false) {
            throw new RuntimeException(sprintf(
                'The file "%s" could not be written to',
                $path
            ));
        }
    }
}