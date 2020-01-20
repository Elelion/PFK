<?php
declare(strict_types=1);


class UserSession
{
  private $authorization = [];
  private $userAccess = [];
  private $userName = null;
  private $access = null;

	public function __construct()
	{
      session_start();

      $sessionStatus = (!isset($_SESSION['user'])) ? false : true;
      $this->setAuthorizationStatus($sessionStatus);
      $this->beginEvent();
	}

	/**/

	private function setAuthorizationStatus(bool $status): void
	{
      $this->authorization = $status;
  }

  public function getAuthorizationStatus(): bool
  {
      return $this->authorization;
  }

  /**/

  private function setUserName(string $name): void
  {
      $this->userName = $name;
  }

  private function setAccess(string $access): void
  {
      $this->access = $access;
  }

  /**/

  public function getUserName(): ?string
  {
      return $this->userName;
  }

  public function getAccess(): ?string
  {
      return $this->access;
  }

  /**/

  private function beginEvent(): void
  {
      if ($this->getAuthorizationStatus() === true) {
          $userSession = $_SESSION['user'];
          foreach ($userSession as $key => $value) {
              $this->userAccess[] = $value;
          }

          $this->setUserName($this->userAccess[0]);
          $this->setAccess($this->userAccess[1]);
      }
  }
}
