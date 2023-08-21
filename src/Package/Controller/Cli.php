<?php
namespace Package\R3m_io\Keyboard\Controller;


use R3m\Io\App;

use R3m\Io\Module\Controller;
use R3m\Io\Module\Data;
use R3m\Io\Module\Dir;
use R3m\Io\Module\File;

use Exception;

use R3m\Io\Exception\LocateException;
use R3m\Io\Exception\ObjectException;
use R3m\Io\Exception\UrlEmptyException;
use R3m\Io\Exception\UrlNotExistException;

class Cli extends Controller {
    const DIR = __DIR__ . '/';
    const MODULE_INFO = 'Info';
    const INFO = [
        '{{binary()}} r3m_io/event                   | Event (Object store) options',
        '{{binary()}} r3m_io/event setup             | Event setup'
    ];

    /**
     * @throws ObjectException
     * @throws Exception
     */
    public static function run(App $object){
        Cli::plugin(
            $object,
            $object->config('project.dir.package') .
            'R3m_io' .
            $object->config('ds') .
            'Node' .
            $object->config('ds') .
            'Plugin' .
            $object->config('ds')
        );
        Cli::validator(
            $object,
            $object->config('project.dir.package') .
            'R3m_io' .
            $object->config('ds') .
            'Node' .
            $object->config('ds') .
            'Validator' .
            $object->config('ds')
        );
        $autoload = [];
        $data = new Data();
//        $data->set('prefix', 'Node');
//        $data->set('directory', $object->config('project.dir.root') . 'Node/');
//        $autoload[] = clone $data->data();
//        $data->clear();
//        $data->set('autoload', $autoload);
//        Cli::autoload($object, $data);
        $node = $object->request(0);
        $scan = Cli::scan($object);
        $module = $object->parameter($object, $node, 1);
        if(!in_array($module, $scan['module'])){
            $module = Cli::MODULE_INFO;
        }
        $submodule = $object->parameter($object, $node, 2);
        if(
            !in_array(
                $submodule,
                $scan['submodule'],
                true
            )
        ){
            $submodule = false;
        }
        $command = $object->parameter($object, $node, 3);
        if(
            !in_array(
                $command,
                $scan['command'],
                true
            ) ||
            $module === Cli::MODULE_INFO ||
            $submodule === Cli::MODULE_INFO
        ){
            $command = false;
        }
        $subcommand = $object->parameter($object, $node, 4);
        if(
            !in_array(
                $subcommand,
                $scan['subcommand'],
                true
            ) ||
            $module === Cli::MODULE_INFO ||
            $submodule === Cli::MODULE_INFO ||
            $command === CLI::MODULE_INFO
        ){
            $subcommand = false;
        }
        $action = $object->parameter($object, $node, 5);
        if(
            !in_array(
                $action,
                $scan['action'],
                true
            ) ||
            $module === Cli::MODULE_INFO ||
            $submodule === Cli::MODULE_INFO ||
            $command === CLI::MODULE_INFO ||
            $subcommand === CLI::MODULE_INFO
        ){
            $action = false;
        }
        $subaction = $object->parameter($object, $node, 6);
        if(
            !in_array(
                $subaction,
                $scan['subaction'],
                true
            ) ||
            $module === Cli::MODULE_INFO ||
            $submodule === Cli::MODULE_INFO ||
            $command === CLI::MODULE_INFO ||
            $subcommand === CLI::MODULE_INFO ||
            $action === CLI::MODULE_INFO
        ){
            $subaction = false;
        }
        $category = $object->parameter($object, $node, 7);
        if(
            !in_array(
                $category,
                $scan['category'],
                true
            ) ||
            $module === Cli::MODULE_INFO ||
            $submodule === Cli::MODULE_INFO ||
            $command === CLI::MODULE_INFO ||
            $subcommand === CLI::MODULE_INFO ||
            $action === CLI::MODULE_INFO ||
            $subaction === CLI::MODULE_INFO
        ){
            $category = false;
        }
        $subcategory = $object->parameter($object, $node, 8);
        if(
            !in_array(
                $subcategory,
                $scan['subcategory'],
                true
            ) ||
            $module === Cli::MODULE_INFO ||
            $submodule === Cli::MODULE_INFO ||
            $command === CLI::MODULE_INFO ||
            $subcommand === CLI::MODULE_INFO ||
            $action === CLI::MODULE_INFO ||
            $subaction === CLI::MODULE_INFO ||
            $category == CLI::MODULE_INFO
        ){
            $subcategory = false;
        }
        try {
            if(
                !empty($module) &&
                !empty($submodule) &&
                !empty($command) &&
                !empty($subcommand) &&
                !empty($action) &&
                !empty($subaction) &&
                !empty($category) &&
                !empty($subcategory)
            ){
                $url = Cli::locate(
                    $object,
                    ucfirst($module) .
                    '.' .
                    ucfirst($submodule) .
                    '.' .
                    ucfirst($command) .
                    '.' .
                    ucfirst($subcommand) .
                    '.' .
                    ucfirst($action) .
                    '.' .
                    ucfirst($subaction) .
                    '.' .
                    ucfirst($category) .
                    '.' .
                    ucfirst($subcategory)
                );
            }
            elseif(
                !empty($module) &&
                !empty($submodule) &&
                !empty($command) &&
                !empty($subcommand) &&
                !empty($action) &&
                !empty($subaction) &&
                !empty($category)
            ){
                $url = Cli::locate(
                    $object,
                    ucfirst($module) .
                    '.' .
                    ucfirst($submodule) .
                    '.' .
                    ucfirst($command) .
                    '.' .
                    ucfirst($subcommand) .
                    '.' .
                    ucfirst($action) .
                    '.' .
                    ucfirst($subaction) .
                    '.' .
                    ucfirst($category)
                );
            }
            elseif(
                !empty($module) &&
                !empty($submodule) &&
                !empty($command) &&
                !empty($subcommand) &&
                !empty($action) &&
                !empty($subaction)
            ){
                $url = Cli::locate(
                    $object,
                    ucfirst($module) .
                    '.' .
                    ucfirst($submodule) .
                    '.' .
                    ucfirst($command) .
                    '.' .
                    ucfirst($subcommand) .
                    '.' .
                    ucfirst($action) .
                    '.' .
                    ucfirst($subaction)
                );
            }
            elseif(
                !empty($module) &&
                !empty($submodule) &&
                !empty($command) &&
                !empty($subcommand) &&
                !empty($action)
            ){
                $url = Cli::locate(
                    $object,
                    ucfirst($module) .
                    '.' .
                    ucfirst($submodule) .
                    '.' .
                    ucfirst($command) .
                    '.' .
                    ucfirst($subcommand) .
                    '.' .
                    ucfirst($action)
                );
            }
            elseif(
                !empty($module) &&
                !empty($submodule) &&
                !empty($command) &&
                !empty($subcommand)
            ){
                $url = Cli::locate(
                    $object,
                    ucfirst($module) .
                    '.' .
                    ucfirst($submodule) .
                    '.' .
                    ucfirst($command) .
                    '.' .
                    ucfirst($subcommand)
                );
            }
            elseif(
                !empty($module) &&
                !empty($submodule) &&
                !empty($command)
            ){
                $url = Cli::locate(
                    $object,
                    ucfirst($module) .
                    '.' .
                    ucfirst($submodule) .
                    '.' .
                    ucfirst($command)
                );
            }
            elseif(
                !empty($module) &&
                !empty($submodule)
            ){
                $url = Cli::locate(
                    $object,
                    ucfirst($module) .
                    '.' .
                    ucfirst($submodule)
                );
            }
            elseif(
                !empty($module)
            ){
                $url = Cli::locate(
                    $object,
                    ucfirst($module)
                );
            }
            return Cli::response($object, $url);
        } catch (Exception | UrlEmptyException | UrlNotExistException | LocateException $exception){
            return $exception;
        }
    }

    private static function scan(App $object): array
    {
        $scan = [
            'module' => [],
            'submodule' => [],
            'command' => [],
            'subcommand' => []
        ];
        $url = $object->config('controller.dir.view');
        if(!Dir::exist($url)){
            return $scan;
        }
        $dir = new Dir();
        $read = $dir->read($url, true);
        if(!$read){
            return $scan;
        }

        foreach($read as $nr => $file){
            if($file->type !== File::TYPE){
                continue;
            }
            $part = substr($file->url, strlen($url));
            $explode = explode('/', $part, 2);
            $submodule = false;
            $command = false;
            $subcommand = false;

            if(array_key_exists(1, $explode)){
                $module = strtolower($explode[0]);
                $temp = explode('.', $explode[1]);
                array_pop($temp);
                $submodule = strtolower($temp[0]);
                if(array_key_exists(1, $temp)){
                    $command = strtolower($temp[1]);
                }
                if(array_key_exists(2, $temp)){
                    $subcommand = strtolower($temp[1]);
                }
            } else {
                $temp = explode('.', $explode[0]);
                array_pop($temp);
                $module = strtolower($temp[0]);
                if(array_key_exists(1, $temp)){
                    $submodule = strtolower($temp[1]);
                }
                if(array_key_exists(2, $temp)){
                    $command = strtolower($temp[1]);
                }
                if(array_key_exists(3, $temp)){
                    $subcommand = strtolower($temp[1]);
                }
            }
            if(
                !in_array(
                    $module,
                    $scan['module'],
                    true
                )
            ){
                $scan['module'][] = $module;
            }
            if(
                $submodule &&
                !in_array(
                    $submodule,
                    $scan['submodule'],
                    true
                )
            ){
                $scan['submodule'][] = $submodule;
            }
            if(
                $command  &&
                !in_array(
                    $command,
                    $scan['command'],
                    true
                )
            ){
                $scan['command'][] = $command;
            }
            if(
                $subcommand &&
                !in_array(
                    $subcommand,
                    $scan['subcommand'],
                    true
                )
            ){
                $scan['subcommand'][] = $subcommand;
            }
        }
        return $scan;
    }
}