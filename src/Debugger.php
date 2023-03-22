<?php
declare(strict_types=1);

namespace SwowCloud\Debugger;

use League\CLImate\CLImate;
use League\CLImate\Util\Writer\Buffer;

class Debugger extends \Swow\Debug\Debugger\Debugger
{
    private CLImate $climate;
    public function __construct()
    {
        parent::__construct();
        $this->climate = new CLImate();
    }

    /**
     * @return $this
     */
    public function out(string $string = '', bool $newline = true, string $color = 'green'): static
    {
        /** @var Buffer $buffer */
        $buffer = $this->climate->output->get('buffer');
        $buffer->clean();
        $this->climate->to('buffer')->{$color}($string);
        $this->output->write([rtrim($buffer->get(), "\n"), $newline ? "\n" : null]);

        return $this;
    }

    public function error(string $string = '', bool $newline = true): static
    {
        $this->out($string, $newline, 'error');

        return $this;
    }

    public function exception(string $string = '', bool $newline = true): static
    {
        $this->out($string, $newline, 'error');

        return $this;
    }

}
