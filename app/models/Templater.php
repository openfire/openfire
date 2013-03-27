<? class Templater
{
			    private $template;

			    function __construct($template = null)
			    {
			        if (isset($template))
			        {
			            $this->load($template);
			        }
			    }


			public function load($template)
			{

				$template = "app/views/" . $template . ".php";
			    /*
			     * This function loads the template file
			     */
			    if (!is_file($template))
			    {
			        echo "File not found: $template";
			    } elseif (!is_readable($template))
			    {
			        echo "Could not access file: $template";
			    } else
			    {
			        $this->template = $template;
			    }
			}

			

			public function set($var, $content)
				{
				    $this->$var = $content;
				}

				public function publish($output = true)
						{
						    /*
						     * Prints out the theme to the page
						     * However, before we do that, we need to remove every var witin {} that are not set
						     * @params
						     *  $output - whether to output the template to the screen or to just return the template
						     */
						    ob_start();
						    require $this->template;
						    $content = ob_get_clean();
						    print $content;
						}

}

?>