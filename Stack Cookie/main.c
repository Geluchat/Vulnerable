#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/socket.h>
#include <sys/types.h>
#include <sys/wait.h>
#include <arpa/inet.h>
#include <unistd.h>
 
int ssock;
 
void vuln(char *source)
{
    char vulnerablebuffer[256]; // Buffer à exploiter
    memset(vulnerablebuffer, '\0', 256);
    strcpy(vulnerablebuffer, source);
}
 
int saisie(void)
{
 
    int csock;
    struct sockaddr_in caddr;
    socklen_t clen = sizeof(caddr);
    char buff[512]={}; // Buffer entrée utilisateur
 
 
    if( (csock = accept(ssock, (struct sockaddr *) &caddr, &clen)) < 0) {
        exit(1);
    }
    memset(buff, '\0', 512);
 
    recv(csock,&buff, 512-1, 0);
    vuln(&buff);
    send(csock, "Daily Security\n", 15, 0);
    close(csock);
 
    return 0;
}
int main(void)
{
    int pid, flag = 1;
    struct sockaddr_in saddr;
 
    saddr.sin_family = AF_INET;
    saddr.sin_addr.s_addr = htonl(INADDR_ANY);
    saddr.sin_port = htons(4444);
    while(1)
    {
        pid = fork();
        if( pid == 0 ) {
 
            if( (ssock = socket(PF_INET, SOCK_STREAM, 0)) < 0) {
                exit(1);
            }
 
            if(setsockopt(ssock, SOL_SOCKET, SO_REUSEADDR, &flag, sizeof(int)) <0) {
                exit(1);
            }
            if( bind(ssock, (struct sockaddr*) &saddr, sizeof(saddr)) < 0) {
                exit(1);
            }
            if( listen(ssock, 5) < 0) {
                exit(1);
            }
            saisie();
            } else {
            wait(NULL);
            close(ssock);
        }
    }
    return 0;
}
