#include <stdio.h>
#include <stdlib.h>
#include <string.h>

void win() {
    system("cat flag.txt");
}

void say_hi() {
    puts("Hi there!");
}

typedef struct {
    char name[16];
    void (*action)();
} Person;

Person p;

void menu() {
    int choice;
    while(1) {
        puts("\n--- Menu ---");
        puts("1) Set name");
        puts("2) Call action");
        puts("3) Exit");
        printf("choice: ");
        if(scanf("%d%*c", &choice) != 1) exit(0);

        if(choice == 1) {
            printf("Enter name: ");
            gets(p.name);  
            puts("Name saved!");
        } else if(choice == 2) {
            p.action();   
        } else if(choice == 3) {
            exit(0);
        } else {
            puts("Invalid choice.");
        }
    }
}

int main() {
    setbuf(stdout, NULL);
    strcpy(p.name, "lwd3c");
    p.action = say_hi; 
    menu();
    return 0;
}
