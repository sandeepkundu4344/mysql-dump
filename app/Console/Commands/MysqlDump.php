<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class MysqlDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MysqlDump:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Take backup of the db if name not provided then take backup of current db';

    /**
     * Db name 
     * Password
     * file name to output
     * @return void
     */
    private $dbname;
    private $password;
    private $backupFolder = 'mysqlbackups';
    private $backupType = 'mysqldump';
    private $mysqlDumpPath = 'mysqldump';
    private $host = '127.0.0.1';
    private $port = '3306';
    private $gzip = false;
    private $dbAll = 'ALL';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->dbname = env('DB_DATABASE');
        $this->username = env('DB_USERNAME');
        $this->password = env('DB_PASSWORD');

        if(env('MYSQL_DUMP_PATH')){
            $this->mysqlDumpPath = env('MYSQL_DUMP_PATH');
        }
        if(env('DB_PORT')){
            $this->port = env('DB_PORT');
        }

        if(env('DB_HOST')){
            $this->host = env('DB_HOST');
        }

        if(env('MYSQL_BACKUP_FOLDER')){
            $this->backupFolder = env('MYSQL_BACKUP_FOLDER');
        }
       
        if(env('GZIP')){
            $this->gzip = env('GZIP');
        }

        if(env('MYSQL_DB_BACKUP')){
            $this->dbAll = env('MYSQL_DB_BACKUP');
        }
        
        $this->outputFile = '';

        //make sure directory exist
        $this->checkIfDirectoryExist();

    }

    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
       
        switch($this->backupType){
            case 'mysqldump':
            $this->mysqlDump();

            break;
            case 'innoDB':
            $this->innoDBBackup();

            break;
            default:



            break;
        }
        
    }
    public function checkIfDirectoryExist(){
        $path = storage_path($this->backupFolder);
        try{
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
        }catch(Exception $e){
            Log::error('MysqlBackup error -> ' .date('Y-m-d H:i:s'). $e->getMessage());
            
        }
        
    }
    public function innoDBBackup(){
        
        // if we need innoddbbackup using percona or other commands
    }

    public function mysqlDump(){
        $dumpCommand = $this->mysqlDumpPath.' -h %s -u %s -p\'%s\' --port %s';

        if($this->dbAll == 'ALL'){
            $dumpCommand = $dumpCommand.' --all-databases';
        }else{
            $dumpCommand = $dumpCommand.' %s';
        }
        if($this->gzip){
            $dumpCommand = $dumpCommand .' | zip > %s';
        }else{
            $dumpCommand = $dumpCommand.' > %s';
        }
       
        if($this->dbAll == 'ALL'){
            $command = sprintf($dumpCommand, $this->host ,$this->username ,$this->password,$this->port, $this->getOutPutPath());
        }else{
            $command = sprintf($dumpCommand, $this->host ,$this->username ,$this->password,$this->port ,$this->dbname, $this->getOutPutPath());
        }
        
       
        $process = new Process($command);
        $process->run();
        if (!$process->isSuccessful()) {
            Log::error('MysqlBackup error -> ' .date('Y-m-d H:i:s'). $process->getOutput());
            //here we can notify our client if backups are failing using any comm method 
        }

    }

    public function getOutPutPath(){
        $path = storage_path($this->backupFolder);
        if($this->outputFile == ''){
            $this->outputFile = date('Y-m-d-H-i-s').'.sql';
        }
       
        if($this->gzip){
           
            return $path ."/". $this->outputFile.".gz";
        }else{
            return $path ."/". $this->outputFile;
        }
        
    }

}
