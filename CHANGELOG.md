### Unreleased

### v0.2.0 (2018-10-04)

* Throw UnknownUserException if attempting to load a user that doesn't exist 
* Refactor DoctrineUserRepository to provide better extension point for custom
  saving of entities (e.g. to add entities that need to be saved with the user).
* Require 0.3 series of warden-core and update repository method names

### v0.1.1 (2018-03-13)

* Now supports either 0.1 or 0.2 series of warden-core

### v0.1.0 (2018-02-13)

* First version, extracted from host project
