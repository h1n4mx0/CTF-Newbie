#include <stdio.h>
#include <stdlib.h>

void win() {
    system("cat flag.txt");
}

void vuln() {
    char name[16];
    printf("Enter your name: ");
    gets(name);   
    printf("Hello, %s!\n", name);
}

int main() {
    vuln();
    printf("Goodbye!");
    return 0;
}
