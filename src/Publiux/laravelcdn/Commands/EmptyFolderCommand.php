<?php

namespace Publiux\laravelcdn\Commands;

use Illuminate\Console\Command;
use Publiux\laravelcdn\Contracts\CdnInterface;

/**
 * Class PushCommand.
 *
 * @category Command
 *
 * @author   Mahmoud Zalt <mahmoud@vinelab.com>
 * @author   Raul Ruiz <publiux@gmail.com>
 * @author   Harrie van der Lubbe <harrie@mindd.eu>
 */
class EmptyFolderCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'cdn:emptyfolder 
                            {folder : The folder to remove}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Empty folder from CDN';

    /**
     * an instance of the main Cdn class.
     *
     * @var Vinelab\Cdn\Cdn
     */
    protected $cdn;

    /**
     * @param CdnInterface $cdn
     */
    public function __construct(CdnInterface $cdn)
    {
        $this->cdn = $cdn;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $folder = $this->argument('folder');
        if (empty($folder)) {
            $this->error('No folder defined! not emptying anything in the bucket.');
        } else {
            $this->info('Emptying folder ' . $folder);
            $result = $this->cdn->emptyFolder($folder);
            if ($result) {
                $this->info('Emptying folder succeeded' );
            } else {
                $this->info('Emptying folder failed. (did the folder exist?).' );
            }
        }
    }
}
