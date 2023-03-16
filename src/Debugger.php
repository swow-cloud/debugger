<?php
declare(strict_types=1);

namespace SwowCloud\Debugger;

use League\CLImate\CLImate;

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
        $buffer = $this->climate->output->get('buffer');
        /* @noinspection PhpPossiblePolymorphicInvocationInspection */
        $buffer->clean();
        $this->climate->to('buffer')->{$color}($string);
        /* @noinspection PhpPossiblePolymorphicInvocationInspection */
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
