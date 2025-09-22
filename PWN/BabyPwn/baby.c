#include <stdio.h>
#include <stdlib.h>
#include <string.h>

void win(){
    system("cat flag.txt");
}

void normal(){
    puts("Nothing here.");
}

char items[3][16];      
void (*action)() = normal;

void menu(){
    int choice;
    while(1){
        puts("\n--- Menu ---");
        puts("1) call action");
        puts("2) edit item");
        puts("3) show items");
        puts("4) exit");
        printf("choice: ");
        if(scanf("%d%*c", &choice) != 1) exit(0);

        if(choice == 1){
            action();
        } else if(choice == 2){
            int idx;
            printf("index: ");
            if(scanf("%d%*c", &idx) != 1) exit(0);

            printf("new: ");
            if(idx == 3){ 
                printf("Overwriting action pointer with print_flag!\n");
                action = win;
                puts("saved.");
            } else if(idx >=0 && idx < 3){
                gets(items[idx]);
                puts("saved.");
            } else {
                puts("Invalid index.");
            }

        } else if(choice == 3){
            puts("--- current items ---");
            for(int i=0;i<3;i++){
                printf("[%d]: %s\n", i, items[i]);
            }
        } else if(choice == 4){
            exit(0);
        } else {
            puts("Invalid choice.");
        }
    }
}

int main(){
    setbuf(stdout, NULL);
    setbuf(stdin, NULL);

    strcpy(items[0], "dog");
    strcpy(items[1], "cat");
    strcpy(items[2], "pig");

    menu();
    return 0;
}
