<?php
	class ConfigFile
	{
		var $file;
		var $model;
		var $params;
		
		function __construct($file, $model = NULL)
		{
			$this->file = $file;
			$this->model = $model;
			if (!is_file($file)) {
				touch($file);
			}
			if (!$model) {
				$this->model = $file .".back";
				copy($this->file, $this->model);
			}
		}

		function param($param, $value)
		{
			$param = quotemeta($param);
			$this->params[$param] = $value;
		}

		function apply($content)
		{
			foreach ($this->params as $p => $v) {
				$content = ereg_replace("([^\r\n]*)$p([^\r\n]*)", $v, $content);
				if ($v != "" && strpos($content, $v) === FALSE) {
					$content .= "\n$v";
				}
			}
			return $content;
		}

		function update()
		{
			$content = file_get_contents($this->model);
			$content = $this->apply($content);
			file_put_contents($this->file, $content);
		}
	}
