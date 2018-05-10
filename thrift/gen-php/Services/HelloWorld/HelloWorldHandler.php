<?

namespace Services\HelloWorld;

class HelloWorldHandler implements HelloWorldIf
{

    /**
     * @param string $name
     * @return string
     */
    public function sayHello($name)
    {
        return "Hello $name";
    }
}