<?php
class FizzBuzz
{
    /** @var array $rules */
    protected $rules = [];
    /** @var string $divider */
    protected $divider = '<br/>';

    /**
     * @param string $divider
     * @return FizzBuzz
     */
    public function setDivider(string $divider): FizzBuzz
    {
        $this->divider = $divider;
        return $this;
    }

    /**
     * @param FizzBuzzRule $rule
     * @return FizzBuzz
     */
    public function addRule(FizzBuzzRule $rule): FizzBuzz
    {
        $this->rules[] = $rule;
        return $this;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return FizzBuzz
     */
    public function run(int $limit = 100, int $offset = 0): FizzBuzz
    {
        for ($i = $offset; $i < $limit; $i++) {
            $outputResult = null;
            foreach ($this->rules as $rule) {
                if ($rule->test($i)) {
                    $outputResult.= $rule->getMessage();
                }
            }
            echo $outputResult ? $outputResult . $this->divider : $i . $this->divider;
        }
        return $this;
    }
}

class FizzBuzzRule
{
    /** @var int $divisibleBy */
    protected $divisibleBy;

    /** @var string $message */
    protected $message;

    /**
     * FizzBuzzRule constructor.
     * @param int $divisibleBy
     * @param string $message
     */
    public function __construct(int $divisibleBy, string $message)
    {
        $this->divisibleBy = $divisibleBy;
        $this->message = $message;
    }

    /**
     * @param int $number
     * @return bool
     */
    public function test(int $number): bool
    {
        return $number % $this->divisibleBy === 0;
    }

    /**
     * @return null|string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}

$fizzBuzz = new FizzBuzz();

$fizzBuzz->addRule(new FizzBuzzRule(5, 'Fizz'));
$fizzBuzz->addRule(new FizzBuzzRule(10, 'Buzz'));
$fizzBuzz->addRule(new FizzBuzzRule(30, 'Jyzz'));

$fizzBuzz->run();
