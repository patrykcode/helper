
# aktualna wersja 

```
java --version
```
# zmiana wersji na wyższa niższą:


```
sudo update-alternatives --config java
```

Są 2 dostępne alternatywy dla java (dostarczającego /usr/bin/java).

  Wybór       Ścieżka                                     Priorytet  Status
------------------------------------------------------------
* 0            /usr/lib/jvm/jdk-17.0.12-oracle-x64/bin/java   285310976 tryb auto
  1            /usr/lib/jvm/java-11-openjdk-amd64/bin/java    1111      tryb ręczny
  2            /usr/lib/jvm/jdk-17.0.12-oracle-x64/bin/java   285310976 tryb ręczny

Proszę wcisnąć <enter>, aby pozostawić bieżący wybór[*]; albo wpisać wybrany numer: 1 << wybór odpowiedniej wersji
update-alternatives: użycie /usr/lib/jvm/java-11-openjdk-amd64/bin/java jako dostarczającego /usr/bin/java (java) w trybie ręcznym


źródło: https://ubuntushell.com/change-java-version/